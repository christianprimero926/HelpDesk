<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Project;
use App\Profile;
use App\ProjectUser;

class UserController extends Controller
{
    public function index()
	{
		$users = User::whereNotIn('profile_id',[1,3])->get();
		//$profiles = Profile::all();
		$profiles = Profile::withTrashed()->get();
		
		return view('admin.users.index')->with(compact('users', 'profiles'));
	}

	public function store(Request $request)
	{		
		$this->validate($request, User::$rules, User::$messages);

		$user = new User();
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->password = bcrypt($request->input('password'));
		$user->profile_id = $request->input('profile_id') ?: 2;
		$user->save();
		
		return back()->with('notification', 'Usuario registrado exitosamente.');
	}

	public function edit($id)
	{
		$user = User::find($id);
		$profiles = Profile::all();
		$projects = Project::all();
		$projects_user = ProjectUser::where('user_id', $user->id)->get();
		return view('admin.users.edit')->with(compact('user', 'projects', 'projects_user','profiles'));
	}

	public function update($id, Request $request)
	{
		$rules = [
			'name' => 'required|max:255',            
            'password' => 'min:6'
		];
		$messages = [
			'name.required' => 'Es necesario ingresar el nombre del usuario.',
			'name.max' => 'El nombre es demasiado extenso.',
			'password.min' => 'La contraseña debe presentar al menos de 6 caracteres.'
		];
		$this->validate($request, $rules, $messages);

		$user = User::find($id);
		$user->name = $request->input('name');

		$password = $request->input('password');
		if ($password) 
			$user->password = bcrypt($password);

		
		$user->save();

		return back()->with('notification', 'Usuario modificado exitosamente.');
	}
    
    public function delete($id)
    {
    	$user = User::find($id);
    	$user->delete();

    	return back()->with('notification', 'El usuario fue dado de baja satisfactoriamente.');
    }
}
