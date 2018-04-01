<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public static $rules = [
		'message' => 'required|max:255'
	];
	public static $messages = [
		'message.required' => 'Olvido ingresar un Mensaje.',
		'message.max' => 'Ingrese como maximo 255 caracteres.',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function incident()
	{
		return $this->belongsTo('App\Incident');
	}
}
