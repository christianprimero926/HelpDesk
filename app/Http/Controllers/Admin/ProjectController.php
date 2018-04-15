<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;

class ProjectController extends Controller
{
    /**
     * Funcion para acceder a la vista principal de proyectos, donde me muestra los proyectos agregados
     * @return type
     */
    public function index()
    {
    	$projects = Project::withTrashed()->get();
    	return view('admin.projects.index')->with(compact('projects'));
    }
    /**
     * Funcion que me almacena los proyectos en la DB
     * @param Request $request 
     * @return type
     */
    public function store(Request $request)
    {    	
		$this->validate($request, Project::$rules, Project::$messages);

		Project::create($request->all());		
		
		return back()->with('notification', 'El proyecto se ha registrado exitosamente.');

    }
    /**
     * Funcion para acceder a la vista editar de un proyecto
     * @param type $id 
     * @return type
     */
    public function edit($id)
    {
    	$project = Project::find($id);
        $categories = $project->categories;
        $levels = $project->levels; //Level:where('project_id', $id)->get();
    	return view('admin.projects.edit')->with(compact('project', 'categories', 'levels'));
    }
    /**
     * Funcion para modificar los cambios ya guardados 
     * @param type $id 
     * @param Request $request 
     * @return type
     */
    public function update($id, Request $request)
    {
    	$this->validate($request, Project::$rules, Project::$messages);
    	Project::find($id)->update($request->all());
    	return back()->with('notification', 'El proyecto se ha actualizado exitosamente.');

    }
    /**
     * Funcion para eliminar un proyecto de forma logica de la DB
     * @param type $id 
     * @return type
     */
    public function delete($id)
    {
        Project::find($id)->delete();

        return back()->with('notification', 'El proyecto se ha deshabilitado exitosamente.');
    }
    /**
     * Funcion para restaurar un proyecto se se desea
     * @param type $id 
     * @return type
     */
    public function restore($id)
    {
        Project::withTrashed()->find($id)->restore();

        return back()->with('notification', 'El proyecto se ha restaurado exitosamente.');
    }
}
