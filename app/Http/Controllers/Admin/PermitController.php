<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\MenuController;
use App\Permit;
use App\Profile;

class PermitController extends Controller
{
    /**
     * Función que lista los roles que tienen permisos asignados de la tabla "foods_permisos" agrupados por ID_rol
     * @return mixed
     */
    public function index(Request $request)
    {

    	$permisos = Permit::groupBy('profile_id')->get();
    	$permisosAsignados = $permisos->map(function ($permiso) {
            return $permiso->profile_id;
        });
    	$profiles = Profile::whereNotIn('id', $permisosAsignados)->get();
    	$menu = MenuController::construirMenuCompleto(0, null);

        /**
         * @var $numeroEnlaces  contiene el total de enlaces de cada rol
         * Se envian los permisos que ya se han dado
         */
        $numeroEnlaces = $this->numeroEnlaces($permisos);

        return view('admin.permits.index')->with(compact('profiles','menu','permisos','numeroEnlaces'));
    }
    /**
     * Funcion que almacena las entradas en la DB de los permisos
     * @param Request $request 
     * @return type
     */
    public function store(Request $request)
	{
        $this->validate($request, Permit::$rules, Permit::$messages);
		 /**
         * Leemos todos los menús que se han seleccionado y creamos objetos
         * para guardar en la tabla de los permisos
         */
        foreach ($request->menu_id as $menu_id) {

            /** @var  $permiso objeto de la clase Permiso (Clase que maneja la tabla de los permisos) */
            $permiso = new Permit();

            /** @var  menu_id Variable que viene en el request desde el form */
            $permiso->menu_id = $menu_id;

            /** @var  profile_id Variable que viene en el request desde el formulario */
            $permiso->profile_id = $request->profile_id;

            /** Guardamos el objeto en la tabla que manejala clase Permiso */
            $permiso->save();
        }		
		
		return back()->with('notification', 'Se han asignado los permisos correctamente.');
	}
    /**
     * Funcion que permite acceder a la vista editar segun el id del perfil
     * @param type $id 
     * @return type
     */
	public function edit($id)
    {
        $profile = Profile::find($id);
        $menu = MenuController::construirMenuCompleto(0, $id);

        return view('admin.permits.edit')->with(compact('profile','menu'));        
    }
    /**
     * Funcion que me permite modificar los datos ya creados
     * @param Request $request 
     * @param type $id 
     * @return type
     */
    public function update(Request $request, $id)
    {
        /**
         * Leemos todos los checkbox marcados y consultamos en la BD si el usuario ya tiene permisos,
         * en caso de no tener permiso lo creamos,
         * al final borramos todos los permisos del rol que no estén en el arreglo de marcados
         */
        foreach ($request->menu_id as $menu_id) {

            $permiso = Permit::where('menu_id',$menu_id)->where('profile_id',$id)->get();
            $permiso = $permiso->count();

            /** Si el resultado es cero, entonces no tiene permiso a ese enlace, así que debemos insertarlo en la BD**/
            if($permiso == 0){
                /**
                 * Creamos un nuevo objeto del modelo Permiso y actualizamos sus atributos para insertar en la BD
                 */
                $permisoNuevo = new Permit();
                $permisoNuevo->menu_id = $menu_id;
                $permisoNuevo->profile_id = $id;
                $permisoNuevo->save();
            }
        }
        /**
         * Eliminamos los permisos que no se encuentran en el arreglo de checkbox marcados que se envió por el formulario
         */
        $permisos = Permit::whereNotIn('menu_id',$request->menu_id)
            ->where('profile_id',$id);
        $permisos->delete();

        return back()->with('notification', 'Se han modificado los permisos correctamente.');
        
    }
    /**
     * Función que retorna que el número de enlaces que hay en permisos
     * @param $ID_rol los permisos de los que se contarán los enlaces
     */
    private function numeroEnlaces($profile_id)
    {
        $totalPermisos[] = 0;

        /**
         * Leemos los permisos que han llegado
         * @var  $key llave de los valores
         * @var  $value valor del arreglo
         */
        foreach ($profile_id As $key => $value) {

            /** @var  $permisos Variable que guardará la consulta del permiso */
            $permisos = Permit::where('profile_id', $value->profile_id)->get();
            /** Total de permisos que se encontraron de cada rol */
            $totalPermisos[$key] = $permisos->count();

        }
        return $totalPermisos;
    }
}
