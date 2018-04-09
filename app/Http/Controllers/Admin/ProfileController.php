<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required'
    	], [
    		'name.required' => 'Es necesario ingresar un nombre para el perfil.'
    	]);

    	Profile::create($request->all());

    	return back()->with('notification', 'El Perfil se ha creado exitosamente.');
    }

    public function edit($id)
    {
        $profiles = Profile::find($id);        
        return view('admin.users.index')->with(compact('profiles'));
    }

    public function update(Request $request)
    {
		$this->validate($request, [
    		'name' => 'required'
    	], [
    		'name.required' => 'Es necesario ingresar un nombre para el perfil.'
    	]);

        $profile_id = $request->input('profile_id');

        $profile = Profile::find($profile_id);
        $profile->name = $request->input('name');
        $profile->save();       

        return back()->with('notification', 'El Perfil se ha modificado exitosamente.');
    }

    public function delete($id)
    {
        Profile::find($id)->delete();

        return back()->with('notification', 'La Perfil se ha deshabilitado exitosamente.');
    }
    public function restore($id)
    {
        Profile::withTrashed()->find($id)->restore();

        return back()->with('notification', 'El Perfil se ha restaurado exitosamente.');
    }
}
