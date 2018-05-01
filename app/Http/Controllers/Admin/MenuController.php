<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Permit;

class MenuController extends Controller
{
    /**
     * Función para retornar todos los elementos de la tabla de los menús
     * @return mixed
     */
    public function index()
    {
        /**
         * Consultamos los menús que tengan un enlace padre con id>=0,
         * ya que el enlace de donde heredan todos será el id = 0 y este tendrá como padre -1
         */
        $menus = Menu::all();
        $maxOrden = $menus->max('orden');        
        return view('admin.menu.index')->with(compact('menus','maxOrden'));
    }
    /**
     * Funcion que me permite almacenar las entradas de un menu
     * @param Request $request 
     * @return type
     */
    public function store(Request $request)
	{
		
		$this->validate($request, Menu::$rules, Menu::$messages);

		$menu = new Menu();
		$menu->name = $request->input('name');
		$menu->src = $request->input('src');
		$menu->orden = $request->input('orden');
		$menu->icon = $request->input('icon');
		$menu->id_padre = $request->input('id_padre');
		if ($menu->icon == '') {
            $menu->icon = 'fa fa-circle-o';
        }
        $menu->save();		
		
		return back()->with('notification', 'La nueva opción ha sido registrada exitosamente.');
	}

	/**
	 * Función que retorna una vista para editar un menú
     * @param $id el id del menú
     * @return mixed
     */
    public function edit($id)
    {
        /** @var  $menu Menu que es el padre */
        $menu = Menu::find($id);
        $menus = Menu::all();
        


        $maxOrden = $menu->max('orden');
        return view('admin.menu.edit')->with(compact('maxOrden','menu','menus'));
    }
	/**
     * Función que actualiza un menú en la base de datos
     * @param MenuRequest $request los datos que se van a actualizar
     * @param $id el id del menú
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        
        Menu::find($id)->update($request->all());
       
        return back()->with('notification', 'Se ha actualizado el menú correctamente.');
        
    }

	/**
     * Función que elimina un menú de la base de datos
     * @param $id el id del menú
     * @return mixed
     */	
    public function delete($id)
    {
        /**
         * Consultamos si el id que será eliminado tiene enlaces hijos,
         * en caso de que los tenga no se podrá eliminar
         */
        $numeroHijos = self::tieneHijos($id);

        if (!$numeroHijos) {

            Menu::find($id)->delete();
            return back()->with('notification', 'Se ha eliminado el menú correctamente.');
            
        } else {
            
            Menu::find($id);
            return back()->with('notification', 'No puede ser eliminado ya que está relacionado con otros enlaces.');
            
        }
    }

	/**
     * Función para consultar si un id está relacionado con otros enlaces
     * @param $id_padre
     * @return bool
     */
    static private function tieneHijos($id_padre)
    {
        $hay = false;

        $menu = Menu::where('id_padre', $id_padre)->count();

        if ($menu > 0) {
            $hay = true;
        }

        return $hay;
    }

	/**
     * Mètodo para construir el menù de acuerdo a los permisos del rol de cada usuario
     * @param int $id_padre el menù padre
     * @param int $id el usuario que solicita el menù
     * @return string
     */
    static public function construirMenu($id_padre = 0, $id = 0)
    {

        $etiquetaMenu = '';
        
        $menus = Menu::where('id_padre', $id_padre)->get();
        $totalMenus = $menus->count();

        if ($totalMenus > 0) {
            $etiquetaMenu .= '';

            foreach ($menus As $menu) {

                /**
                 * AVISO IMPORTANTE
                 */
                /** Esta variable debe ir en false, se cambia temporalmente */
                $tienePermiso = false;

                /**
                 * Comprobamos si el id que se recibe no es null, y cambiamos el valor de la variable
                 * @param $tienePermiso para marcar el checkbox que tiene el permiso
                 */
                if ($id != null) {

                    $permisos = Permit::where('menu_id', $menu->id)
                        ->where('profile_id', $id);

                    $totalPermiso = $permisos->count();

                    if ($totalPermiso > 0) {
                        $tienePermiso = true;
                    }
                }


                /**
                 * Consultamos si el menú que se está creando tiene hijos para crear en enlace
                 * true si tiene hijos, false si no tiene
                 */
                $numeroHijos = self::tieneHijos($menu->id);

                if ($numeroHijos && $tienePermiso) {

                    $etiquetaMenu .= '<li class="treeview">';
                    $etiquetaMenu .= '<a href="' . url($menu->src) . '">';
                    $etiquetaMenu .= '<i class="' . $menu->icon . ' "></i>';
                    $etiquetaMenu .= '<span>' . $menu->name . '</span>';
                    $etiquetaMenu .= '<i class="fa fa-angle-left pull-right"></i>';
                    $etiquetaMenu .= '</a>';

                    $etiquetaMenu .= '<ul class="treeview-menu">';
                    $etiquetaMenu .= self::construirMenu($menu->id, $id);
                    $etiquetaMenu .= '</ul>';

                    $etiquetaMenu .= '</li>';
                } else if ($tienePermiso) {
                    $etiquetaMenu .= '<li>';
                    $etiquetaMenu .= '<a href="' . url($menu->src) . '">';
                    $etiquetaMenu .= '<i class="' . $menu->icon . '"></i>';
                    $etiquetaMenu .= '<span>' . $menu->name . '</span>';
                    $etiquetaMenu .= '</a>';
                    $etiquetaMenu .= '</li>';
                }
            }

        }
        return $etiquetaMenu;
    }

	 /**
     * Función para retornar el menú completo
     * esta función se crea inicialmente para la creación y actualización de permisos
     * @param int $id_padre
     * @param int $id id del rol que se va a consultar los permisos, para la creación de un permiso se envia este campo como vacio
     * @return string
     */
    static public function construirMenuCompleto($id_padre = 0, $id)
    {

        $etiquetaMenu = '';
        $menus = Menu::where('id_padre', $id_padre)->get();
        $totalMenus = $menus->count();

        if ($totalMenus > 0) {
            $etiquetaMenu .= '';

            foreach ($menus As $menu) {

                $marcar = '';

                /**
                 * Comprobamos si el id que se recibe no es null, y cambiamos el valor de la variable
                 * @param $marcar para marcar el checkbox que tiene el permiso
                 */
                if ($id != null) {

                    $permisos = Permit::where('menu_id', $menu->id)->where('profile_id', $id);

                    $totalPermiso = $permisos->count();

                    if ($totalPermiso > 0) {
                        $marcar = 'checked';
                    }
                }

                /**
                 * Consultamos si el menú que se está creando tiene hijos para crear en enlace
                 * true si tiene hijos, false si no tiene
                 */
                $numeroHijos = self::tieneHijos($menu->id);

                if ($numeroHijos) {

                    $etiquetaMenu .= '<ul class="autoCheckbox">';
                    $etiquetaMenu .= '<li class="">';
                    $etiquetaMenu .= '<a href="">';
                    $etiquetaMenu .= '<label class="checkbox">';
                    $etiquetaMenu .= '<input type="checkbox" value="' . $menu->id . '" name="menu_id[]" ' . $marcar . ' >&nbsp';
                    $etiquetaMenu .= $menu->name;
                    $etiquetaMenu .= '</label>';
                    $etiquetaMenu .= '</a>';
                    $etiquetaMenu .= '<ul class="autoCheckbox">';
                    $etiquetaMenu .= self::construirMenuCompleto($menu->id, $id);
                    $etiquetaMenu .= '</ul>';
                    $etiquetaMenu .= '</li>';
                    $etiquetaMenu .= '</ul>';
                } else {
                    $etiquetaMenu .= '<ul class="autoCheckbox">';
                    $etiquetaMenu .= '<li class="treeview">';
                    $etiquetaMenu .= '<a href="#">';
                    $etiquetaMenu .= '<label class="checkbox">';
                    $etiquetaMenu .= '<input type="checkbox" value="' . $menu->id . '" name="menu_id[]" ' . $marcar . ' >&nbsp';
                    $etiquetaMenu .= $menu->name;
                    $etiquetaMenu .= '</label>';
                    $etiquetaMenu .= '</a>';
                    $etiquetaMenu .= '</li>';
                    $etiquetaMenu .= '</ul>';
                }

            }
        }
        return $etiquetaMenu;
    }

	/**
     * Retorna el orden máximo que tienen los hijos
     * @param $id
     * @return mixed
     */
    public function getHijos($id)
    {
        return Menu::where('id_padre', $id)->max('orden');
    }
}
