<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Incident;
use App\Project;
use App\ProjectUser;
use App\Message;

class IncidentController extends Controller
{
    /**
     * para verificar que se ha logeado
     * @return type
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Funcion que me muestra todas las incidencias
     * @return type
     */
    public function index()
    {
        $user = auth()->user();
        $selected_project_id = $user->selected_project_id;

        $users = User::where('profile_id',2)->get();        
        $incidents = Incident::where('project_id', $selected_project_id)->get();
        $incidents = Incident::all();                
        return view('incidents.index')->with(compact('incidents','users'));
    }

    /**
     * funcion que me permite asignar una incidencia a un usuario
     * @param Request $request 
     * @return type
     */
    public function assign(Request $request)
    {
        $incident_id = $request->input('incident_id');
        $incident = Incident::find($incident_id);
        $incident->support_id = $request->input('support_id');
        // dd($incident->support_id);
        $incident->save();
        // dd($incident);

        return back()->with('notification', 'Se ha asignado la incidencia exitosamente.');
    }

    public function reassign(Request $request)
    {
        $incident_id = $request->input('incident_id');
        $incident = Incident::findOrFail($incident_id);
        $incident->support_id = $request->input('support_id');
        $incident->save();

        return back()->with('notification', 'Se ha asignado la incidencia exitosamente.');
    }

    /**
     * Funcion para mostrar los detalles de una incidencia
     * @param type $id 
     * @return type
     */
    public function show($id)
    {
        $incident = Incident::findOrFail($id);
        //$project = Project::all();
        $messages = $incident->messages;
        //dd($incident->name);
        return view('incidents.show')->with(compact('incident', 'messages'));
    }
    /**
     * Funcion para crear una incidencia, donde por defecto se le asigna la primera categoria
     * @return type
     */
    public function create()
    {
        // $project = Project::finf(1);
        // $categories = $project->categories;
        $user = auth()->user();
        $selected_project_id = $user->selected_project_id;

        $categories = Category::where('project_id', $selected_project_id)->get();        
        return view('incidents.create')->with(compact('categories'));
    }
    /**
     * Funcion que me almacena las incidencias reportadas en la DB
     * @param Request $request 
     * @return type
     */
    public function store(Request $request)
    {
        $this->validate($request, Incident::$rules, Incident::$messages);
        
        $incident = new Incident();
        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->title = $request->input('title');
        $incident->description = $request->input('description');

        $user = auth()->user();

        $incident->client_id = $user->id;
        $incident->project_id = $user->selected_project_id;
        $incident->level_id = Project::find($user->selected_project_id)->first_level_id;

        $incident->save();

        return back()->with('notification', 'Se ha reportado la incidencia exitosamente.');              
    }

    /**
     * Funcion para acceder a la vista editar una incidencia
     * @param type $id 
     * @return type
     */
    public function edit($id)
    {
        $incident = Incident::findOrFail($id);
        $categories = $incident->project->categories;
        return view('incidents.edit')->with(compact('incident', 'categories'));
    }

    /**
     * Funcion que me permite actualizar una incidencia
     * @param type $id 
     * @param Request $request 
     * @return type
     */
    public function update($id, Request $request)
    {
        $this->validate($request, Incident::$rules, Incident::$messages);
        
        $incident = Incident::findOrFail($id);
        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->title = $request->input('title');
        $incident->description = $request->input('description');             

        $incident->save();

        return redirect("/ver/$id");
    }
    /**
     * Funcion que le permite a un usuario de soporte tomar una incidencia, si esta aun no ha sido asignada 
     * @param type $id 
     * @return type
     */
    public function take($id)
    {
        $user = auth()->user();

        if (! $user->is_support) {
            return back();
        }

        $incident = Incident::findOrFail($id);

        $project_user = ProjectUser::where('project_id', $incident->project_id)->where('user_id', $user->id)->first();

        //There is a relationship beetween user and project
        if(! $project_user)
            return back();

        //The level is the same?
        if($project_user->level_id != $incident->level_id)
            return back();
        
        $incident->support_id = $user->id;
        $incident->save();

        return back();
    }
    /**
     * Funcion para cambiar el estado de una incidencia a resuelta
     * @param type $id 
     * @return type
     */
    public function solve($id)
    {

        $incident = Incident::findOrFail($id);

        //Is the user authenticated the author of the incident?
        if ($incident->client_id != auth()->user()->id) {
            return back();
        }

        
        $incident->active = 0;// false
        $incident->save();

        return back();
    }
    /**
     * Funcion para volver abrir una incidencia,una vez resuelta
     * @param type $id 
     * @return type
     */
    public function open($id)
    {
        $incident = Incident::findOrFail($id);

        //Is the user authenticated the author of the incident?
        if ($incident->client_id != auth()->user()->id) {
            return back();
        }

        
        $incident->active = 1;// true
        $incident->save();

        return back();
    }    
    /**
     * funcion para derivar a una incidencia, en caso de que un usuario de sporte de un nivel no sea capaza de atenderla, se la pasa a un usuario de sgte nivel, hasta que llega a el ultimo y no se puede derivar mas por que no existira mas niveles
     * si el ultimo usurio de este nivel no es capaz de atenderla,que sucede??
     * @param type $id 
     * @return type
     */
    public function nextLevel($id)
    {
        $incident = Incident::findOrFail($id);
        $level_id = $incident->level_id;
        
        $project = $incident->project;
        $levels = $project->levels;

        $next_level_id = $this->getNextLevelId($level_id, $levels);

        if($next_level_id){
            $incident->level_id = $next_level_id;
            $incident->support_id = null;
            $incident->save();
            return back();
        }
        return back()->with('notification-warning','No es posible derivar al siguiente nivel, ya que no hay mas niveles.');        
    }
    /**
     * Funcion para derivar de nivel
     * @param type $level_id 
     * @param type $levels 
     * @return type
     */
    public function getNextLevelId($level_id, $levels)
    {
        if (sizeof($levels) <= 1) {
            return null;
        }

        $position = -1;
        for ($i=0; $i<sizeof($levels) ; $i++) { 
            if ($levels[$i]->id == $level_id) {
                $position = $i;
                break;
            }
        }
        if ($position == -1) {
            return null;
        }
        if($position == sizeof($levels)-1)
            return null;

        return $levels[$position+1]->id;
    }

}
