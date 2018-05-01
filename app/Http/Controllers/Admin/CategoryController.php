<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Funcion que me permite almacenar las diferentes categorias de un proyecto
     * @param Request $request 
     * @return type
     */
    public function store(Request $request)
    {
    	$this->validate($request, Category::$rules, Category::$messages);

    	Category::create($request->all());

    	return back()->with('notification', 'La Categoria se ha registrado exitosamente.');
    }
    /**
     * Funcion que me permite modificar dichas categorias
     * @param Request $request 
     * @return type
     */
    public function update(Request $request)
    {
		$this->validate($request, Category::$rules, Category::$messages);

		$category_id = $request->input('category_id');

		$category = Category::find($category_id);
		$category->name = $request->input('name');
		$category->save();    	

    	return back()->with('notification', 'La Categoria se ha modificado exitosamente.');
    }
    /**
     * Funcion que me elimina categorias de manera manera logica,(para evitarse el dolor de romper relaciones)
     * @param type $id 
     * @return type
     */
    public function delete($id)
    {
        Category::find($id)->delete();

        return back()->with('notification', 'La Categoria se ha deshabilitado exitosamente.');
    }
}
