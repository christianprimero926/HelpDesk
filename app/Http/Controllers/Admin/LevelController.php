<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Level;

class LevelController extends Controller
{
    /**
     * Funcion que segun el proyecto, me muestra los niveles que este tiene
     * @param type $id 
     * @return type
     */
    public function byProject($id)
    {
        return Level::where('project_id', $id)->get();
    }
    /**
     * Funcion que me permite almacenar los diferentes niveles que puede tener un proyecto
     * @param Request $request 
     * @return type
     */
    public function store(Request $request)
    {
    	$this->validate($request, Level::$rules, Level::$messages );

    	Level::create($request->all());
    	return back()->with('notification', 'El nivel se ha registrado exitosamente.');
    }
    /**
     * Funcion que me permite modificar los niveles 
     * @param Request $request 
     * @return type
     */
    public function update(Request $request)
    {
		$this->validate($request, Level::$rules, Level::$messages );

		$level_id = $request->input('level_id');

		$level = level::find($level_id);
		$level->name = $request->input('name');
		$level->save();    	

    	return back()->with('notification', 'El nivel se ha modificado exitosamente.');
    }
    /**
     * Funcion que me elimina niveles de manera manera logica,(para evitarse el dolor de romper relaciones)
     * @param type $id 
     * @return type
     */
    public function delete($id)
    {
        Level::find($id)->delete();
        return back()->with('notification', 'El nivel se ha deshabilitado exitosamente.');
    }
}
