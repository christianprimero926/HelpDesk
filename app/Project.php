<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
	
    public static $rules = [
			'name' => 'required|max:255',
            'description' => 'max:2000',
            'start' => 'date',
		];
	public static $messages = [
		'name.required' => 'Es necesario ingresar el nombre del usuario.',
		'name.max' => 'El nombre es demasiado extenso.',

		'description.max' => 'La descripción es demasiada extensa.',			

		'start.date' => 'La fecha no tiene el formato adecuado.'			
	];

	protected $fillable = [
        'name', 'description', 'start',
    ];

    //Relationships

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function categories()
    {
    	return $this->hasMany('App\Category');
    }

    public function levels()
    {
    	return $this->hasMany('App\Level');
    }
    public function incident()
    {
        return $this->hasMany('App\Incident');
    }

    //Accessors
    
    public function getFirstLevelIdAttribute()
    {
        return $this->levels->first()->id;
    }

    public function getDescriptionShortAttribute()
    {
        return mb_strimwidth($this->description, 0, 60, '...');
    }
}
