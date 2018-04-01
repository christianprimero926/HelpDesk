<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    //Category Name
    public function getProfileNameAttribute()
    {
        if ($this->profile)
            return $this->profile->name;
        
        return 'Invitado';
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

    public function getChargeAttribute()
    {
        switch ($this->profile_id) {
            case 1:
                return 'Admin';
            case 2:
                return 'Support';            
            
            case 3:                
                return 'Client';
        }
    }
}
