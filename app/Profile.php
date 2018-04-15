<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
	use SoftDeletes;

    public static $rules = [
            'name' => 'required|unique:profiles'
        ];
    public static $messages = [
        'name.required' => 'Es necesario ingresar un nombre para el perfil.',
        'name.unique' => 'Ya existe este nombre en nuestra base de datos.'
    ];
	
	protected $fillable = ['name', 'user_id'];

    public function user()
    {
    	return $this->hasMany('App\User');
    }

    public function permit()
    {
    	return $this->hasMany('App\Profile');
    }
}
