<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Incident;
use App\ProjectUser;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $selected_project_id = $user->selected_project_id;
        
        if($user->is_support or $user->is_admin){
            $my_incidents = Incident::where('project_id', $selected_project_id)->where('support_id', $user->id)->get();

            $projectUser = ProjectUser::where('project_id', $selected_project_id)->where('user_id', $user->id)->first();
            
            $pending_incidents = Incident::where('support_id', null)->where('level_id', $projectUser->level_id)->get();
            
            $incidents_by_me = Incident::where('client_id', $user->id)->where('project_id', $selected_project_id)->get();
            
            return view('home')->with(compact('incidents_by_me', 'projectUser', 'my_incidents', 'pending_incidents'));
        }        

        $incidents_by_me = Incident::where('client_id', $user->id)->where('project_id', $selected_project_id)->get();
        
        return view('home')->with(compact('incidents_by_me'));
    }

    /**
     * Funcion para seleccionar un proyecto y ver la informacion de este, si es un usuario de soporte, solo se mostraran los proyectos asignados a este
     * @param type $id 
     * @return type
     */
    public function selectProject($id)
    {
        // Validar que el usuario este asociado con el proyecto
        $user = auth()->user();
        $user->selected_project_id = $id;
        $user->save();

        return back();
    }
    
}
