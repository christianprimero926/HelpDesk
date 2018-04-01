<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required'
    	], [
    		'name.required' => 'Es necesario ingresar un nombre para la categoria.'
    	]);

    	Category::create($request->all());

    	return back()->with('notification', 'La Categoria se ha registrado exitosamente.');
    }

    public function update(Request $request)
    {
		$this->validate($request, [
    		'name' => 'required'
    	], [
    		'name.required' => 'Es necesario ingresar un nombre para la categoria.'
    	]);

		$category_id = $request->input('category_id');

		$category = Category::find($category_id);
		$category->name = $request->input('name');
		$category->save();    	

    	return back()->with('notification', 'La Categoria se ha modificado exitosamente.');
    }

    public function delete($id)
    {
        Category::find($id)->delete();

        return back()->with('notification', 'La Categoria se ha deshabilitado exitosamente.');
    }
}
