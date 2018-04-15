<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public static $rules = [
		'name' => 'required'
	];
	public static $messages = [
		'name.required' => 'Es necesario ingresar un nombre para la categoria.'
	];

    protected $fillable = ['name', 'project_id'];

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }
}
