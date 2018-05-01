<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    public static $rules = [
            'profile_id' => 'required',
            'menu_id' => 'required'

        ];
    public static $messages = [
        'profile_id.required' => 'Debe seleccionar un rol al que quiera dar permisos',
        'menu_id.required' => 'Debe marcar los menús que desea habilitar'
    ];
	protected $table = 'permits';
    protected $fillable = ['id','menu_id','profile_id'];

    /**
     * Un permiso solo tiene un rol
     * relación 1:N
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

    public function getProfileNameAttribute()
    {
        if ($this->profile)
            return $this->profile->name;
        
        return 'Invitado';
    }
}
