<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    //validations
    public static $rules = [
    'category_id' => 'sometimes|exists:categories,id',
    'severity' => 'required|in:M,N,A',
    'title' => 'required|min:5',
    'description' => 'required|min:15'
    ];

    public static $messages = [
        'category_id.exists' => 'La Categoria seleccionada no existe en nuestra base de datos.',
        'title.required' => 'No ha ingresado un titulo para la incidencia.',
        'title.min' => 'El titulo debe tener al menos 5 caracteres.',
        'description.required' => 'Es necesario ingresar una descripción para la incidencia.',
        'description.min' => 'La descripción debe presentar al menos 15 caracteres.'
    ];

    //Relationships

    protected $appends = ['state'];

     public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function level()
    {
    	return $this->belongsTo('App\Level');
    }

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }

    public function support()
    {
    	return $this->belongsTo('App\User', 'support_id');
    }
    
    public function messages()
    {
    	return $this->hasMany('App\Message');
    }

    public function client()
    {
        return $this->belongsTo('App\User', 'client_id');
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile'/*,[client->profile_id]*/);
    }

    //Accesors

    //Severity Name
    public function getSeverityFullAttribute()
    {
    	switch ($this->severity) {
    		case 'M':
    			return 'Menor';
    		case 'N':
    			return 'Normal';   			
    		
    		default:    			
    			return 'Alta';
    	}
    }

    //title short
    public function getTitleShortAttribute()
    {
    	return mb_strimwidth($this->title, 0, 20, '...');
    }

    //Category Name
    public function getCategoryNameAttribute()
    {
        if ($this->category)
            return $this->category->name;
        
        return 'General';
    }

    //Project Name
    public function getProjectNameAttribute()
    {
        if ($this->project)
            return $this->project->name;
    }   
   
    //Support Name
    public function getSupportNameAttribute()
    {
    	if ($this->support)
    		return $this->support->name;
    	
    	return 'Sin asignar';
    }

    //client Name
    public function getClientNameAttribute()
    {
        if ($this->client)
            return $this->client->name;
        
        return 'Sin asignar';
    }

    //Profile Name
    public function getProfileNameAttribute()
    {
        if ($this->client)
            return $this->client->profile_id;
        /*
        if ($this->profile)
            return $this->profile->name;
        */
    }

    //State    
    public function getStateAttribute()
    {
    	if ($this->active == 0)
    		return 'Resuelta';
    	
    	if($this->support_id)
    		return 'Asignado';

    	return 'Pendiente';
    }
}
