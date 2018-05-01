<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

class ProfileController extends Controller
{
    /**
     * Función que retorna todos los registros de la tabla de roles
     * @return mixed
     */
    public function index()
    {
        //$profiles = Profile::all();
        $profiles = Profile::withTrashed()->get();
        //$roles = Rol::Search($request->buscar)->orderBy('nombre','ASC')->paginate(10);
        return view('admin.profiles.index')->with(compact('profiles'));
    }
    /**
     * Funcion que almacena un perfil de usuario en la DB
     * @param Request $request 
     * @return mixed
     */
    public function store(Request $request)
    {
    	$this->validate($request, Profile::$rules, Profile::$messages);

    	Profile::create($request->all());

    	return back()->with('notification', 'El Perfil se ha creado exitosamente.');
    }
    /**
     * Funcion que me permite accder a la vista editar y editar un perfil
     * @param type $id 
     * @return type
     */
    public function edit($id)
    {
        $profiles = Profile::find($id);        
        return view('admin.users.index')->with(compact('profiles'));
    }
    /**
     * Funcion para modificar o actualizar los cambios
     * @param Request $request 
     * @return type
     */
    public function update(Request $request)
    {
		$this->validate($request, Profile::$rules, Profile::$messages);

        $profile_id = $request->input('profile_id');

        $profile = Profile::find($profile_id);
        $profile->name = $request->input('name');
        $profile->save();       

        return back()->with('notification', 'El Perfil se ha modificado exitosamente.');
    }
    /**
     * Funcion para eliminar un perfil de forma logica
     * @param type $id 
     * @return type
     */
    public function delete($id)
    {
        Profile::find($id)->delete();

        return back()->with('notification', 'La Perfil se ha deshabilitado exitosamente.');
    }
    /**
     * Funcion para habilitar el perfil en caso de que se requiera
     * @param type $id 
     * @return type
     */
    public function restore($id)
    {
        Profile::withTrashed()->find($id)->restore();

        return back()->with('notification', 'El Perfil se ha restaurado exitosamente.');
    }
}
