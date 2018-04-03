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

    //Profile Name
    public function getProfileNameAttribute()
    {
        if ($this->profile)
            return $this->profile->name;
        
        return 'Invitado';
    }

    public function getMonthAttribute()
    {
        switch ($this->created_at) {
            case 1:
                return 'Enero';
            case 2:
                return 'Febrero';
            case 3:                
                return 'Marzo';
            case 4:                
                return 'Abril';
            case 5:                
                return 'Mayo';
            case 6:                
                return 'Junio';
            case 7:                
                return 'JUlio';
            case 8:                
                return 'Agosto';
            case 9:                
                return 'Septiembre';
            case 10:                
                return 'Octubre';
            case 11:                
                return 'Noviembre';
            case 12:                
                return 'Diciembre';
        }
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
