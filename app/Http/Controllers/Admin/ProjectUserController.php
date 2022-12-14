<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProjectUser;

class ProjectUserController extends Controller
{
    /**
     * Funcion para asignarle un proyecto a un usuario
     * @param Request $request 
     * @return type
     */
    public function store(Request $request)
    {

    	//Validaciones para hacer
    	//El nivel pertenezca al proyecto.
    	//Asegurar que el proyecto exista.    	
    	//Asegurar que el nivel exista.    	
    	//Asegurar que el usuario exista.

    	$project_id = $request->input('project_id');
    	$user_id = $request->input('user_id');

    	$project_user = ProjectUser::where('project_id', $project_id)->where('user_id', $user_id)->first();

    	if($project_user)
    		return back()->with('notification-warning', 'El usuario ya pertenece a este proyecto.');
    	

    	$project_user = new ProjectUser();
    	$project_user->project_id = $project_id;
    	$project_user->user_id = $user_id;
    	$project_user->level_id = $request->input('level_id');
    	$project_user->save();

    	return back()->with('notification', 'Se ha asignado el proyecto exitosamente.');
    }
    /**
     * Funcion para eliminar un proyecto asignado a un usuario de forma fisica
     * @param type $id 
     * @return type
     */
    public function delete($id)
    {
    	ProjectUser::find($id)->delete();
    	return back()->with('notification', 'El proyecto se ha removido exitosamente.');
    }
}
