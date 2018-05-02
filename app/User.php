<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    public static $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'profile_id' => 'sometimes|exists:profiles,id',

        ];
    public static $messages = [
        'name.required' => 'Es necesario ingresar el nombre del usuario.',
        'name.max' => 'El nombre es demasiado extenso.',

        'email.required' => 'Es indispensable ingresar el e-mail del usuario.',
        'email.email' => 'El e-mail ingresado no es valido.',
        'email.max' => 'El e-mail es demasiado extenso.',
        'email.unique' => 'Este e-mail ya se encuentra en uso.',

        'password.required' => 'Olvido ingresar la contraseña.',
        'password.min' => 'La contraseña debe presentar al menos 6 caracteres.',
        'profile_id.exists' => 'El perfil seleccionado no existe en nuestra base de datos.',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relationships
    
    public function socialProvider()
    {
        return $this->hasMany(socialProvider::class);
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function canTake(Incident $incident)
    {
        return ProjectUser::where('user_id', $this->id)->where('level_id', $incident->level_id)->first();
    }

    /**Accessors**/

    //Profile Name
    public function getProfileNameAttribute()
    {
        if ($this->profile)
            return $this->profile->name;
    }
    
    public function getListOfProjectsAttribute()
    {
        if($this->profile_id == 2)
            return $this->projects;
        
        return Project::all();
    }

    public function getIsAdminAttribute()
    {
        return $this->profile_id == 1;
    }

    public function getIsSupportAttribute()
    {
        return $this->profile_id == 2;
    }

    public function getIsClientAttribute()
    {
        return $this->profile_id == 3;
    }
    
}
