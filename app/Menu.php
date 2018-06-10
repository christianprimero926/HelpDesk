<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Módelo que contiene los datos de los menús
 * Class Menu
 * @package App
 */
class Menu extends Model
{
    public static $rules = [
            'name' => 'min:3|required',
            'src' => 'min:1|required',
           // 'orden' => 'required|unique:foods_menu,orden,'.$this->route->getParameter('menu'),
            'orden' => 'required',
            'id_padre' => 'required',
            'as' => 'required'

        ];
    public static $messages = [
        'name.required' => 'Es necesario ingresar un nombre para la opcion.',
        'name.min' => 'El nombre es demasiado corto.',
        'src.unique' => 'No pueden existir dos menús con la misma ruta',
        'orden.unique' => 'No pueden existir dos menús con el mismo orden',
        'as.required' => 'Es necesario ingresar el nombre de la ruta'        
    ];
    protected $table = 'menu';
    protected $fillable = ['id', 'name', 'src', 'orden', 'icon', 'id_padre', 'as'];
    /**
     * Un menú solo tiene un padre
     * relación 1:N
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function padre()
    {
        return $this->belongsTo('App\Menu','id_padre');
    }
	/**
    public function scopeSearch($query, $buscar)
    {
        return $query->where('nombre', 'LIKE', "%$buscar%")
            ->orWhere('src', 'LIKE', "%$buscar%");
    }
    */
    
    public function getNamePadreAttribute()
    {
        if ($this->padre)
            return $this->padre->name;
    }
    
}
