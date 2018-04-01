<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Incident;
use App\Project;
use App\ProjectUser;
use App\Message;

class IncidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $incident = Incident::findOrFail($id);
        $messages = $incident->messages;
        return view('incidents.show')->with(compact('incident', 'messages'));
    }
    
    public function create()
    {
        // $project = Project::finf(1);
        // $categories = $project->categories;
        $categories = Category::where('project_id', 1)->get();        
        return view('incidents.create')->with(compact('categories'));
    }

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

    public function edit($id)
    {
        $incident = Incident::findOrFail($id);
        $categories = $incident->project->categories;
        return view('incidents.edit')->with(compact('incident', 'categories'));
    }

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
