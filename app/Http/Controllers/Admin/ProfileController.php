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

    	return back()->with('notification', 'La Perfil se ha creado exitosamente.');
    }

    public function update(Request $request)
    {
		$this->validate($request, [
    		'name' => 'required'
    	], [
    		'name.required' => 'Es necesario ingresar un nombre para el perfil.'
    	]);

		$profile_id = $request->input('category_id');

		$profile = Profile::find($category_id);
		$profile->name = $request->input('name');
		$profile->save();    	

    	return back()->with('notification', 'La Categoria se ha modificado exitosamente.');
    }

    public function delete($id)
    {
        Profile::find($id)->delete();

        return back()->with('notification', 'La Categoria se ha deshabilitado exitosamente.');
    }
}
