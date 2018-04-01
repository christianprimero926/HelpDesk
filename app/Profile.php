<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
	use SoftDeletes;
	
	protected $fillable = ['name', 'user_id'];

    public function user()
    {
    	return $this->hasMany('App\User');
    }
}
