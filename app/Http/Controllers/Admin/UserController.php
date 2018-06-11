<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Project;
use App\Profile;
use App\ProjectUser;
use App\Incident;


/**
<div class="box-footer box-comments">
@foreach($messages as $message)
<div class="box-comment">
<!-- User image -->
<img class="img-circle img-sm" src="{{$message->user->avatar}}" alt="User Image">

<div class="comment-text">
<span class="username">
{{ $message->user->name }}
<span class="text-muted pull-right">{{ $message->created_at }}</span>
</span><!-- /.username -->
{{ $message->message }}
</div>
<!-- /.comment-text -->
</div>
@endforeach

</div>
<!-- /.box-footer -->
<div class="box-footer">
<form action="/mensajes" method="POST">
{{ csrf_field() }}
<input type="hidden" name="incident_id" value="{{ $incident->id }}">
<img class="img-responsive img-circle img-sm" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
<!-- .img-push is used to add margin to elements next to floating images -->


<div class="img-push form inline">
<input type="text" name="message" placeholder="Escribe un Mensaje ..." class="form-control">
<span class="input-group-btn">                
<button type="submit" class="btn btn-success btn-flat">Enviar</button>
</span>
</div>
</form>
</div>
<!-- /.box-footer -->
 */



class UserController extends Controller
{
	public function profile()
	{
		
		$user = auth()->user();
        $selected_project_id = $user->selected_project_id;
        $users = User::where('profile_id',2)->get();        
        $incidents = Incident::where('project_id', $selected_project_id)->get();
        if($user->is_support){
            $my_incidents = Incident::where('project_id', $selected_project_id)->where('support_id', $user->id)->get();
            $num_my_incidencias = $my_incidents->count();
            $solve_incidents = $my_incidents->where('active', 0)->count();
            $projectUser = ProjectUser::where('project_id', $selected_project_id)->where('user_id', $user->id)->first();
            $pending_incidents = Incident::where('support_id', null)->where('level_id', $projectUser->level_id)->get();
        }
        $incident_total = Incident::all()->count();
        $incidents_by_me = Incident::where('client_id', $user->id)->where('project_id', $selected_project_id)->get();
        $num_incidencias_by_me = $incidents_by_me->count();
        return view('profile.index')->with(compact('incidents','user','my_incidents', 'pending_incidents', 'incidents_by_me', 'num_my_incidencias', 'num_incidencias_by_me', 'incident_total', 'solve_incidents'));
		
	}
	public function update_avatar($id,Request $request)
	{		
		$user = User::findOrFail($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->password = bcrypt($request->input('password'));
		if ($request->hasFile('avatar')) {
			$user->avatar = $request->file('avatar')->store('public');
		}
		$user->save();
		return back()->with('notification', 'Imagen Modificada exitosamente.');
	}

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
			'name' => 'required|max:255'            
            
		];
		$messages = [
			'name.required' => 'Es necesario ingresar el nombre del usuario.',
			'name.max' => 'El nombre es demasiado extenso.'
			
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
