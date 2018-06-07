<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});
//Mailbox
/*Route::get('/correo', function () {
	return view('mailbox');
	});//New E-mail
Route::get('/correo/nuevo', function () {
	return view('newmail');
	});//Read E-mail
Route::get('/correo/leer', function () {
	return view('readmail');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/seleccionar/proyecto/{id}', 'HomeController@selectProject');


//Permits
	Route::get('/permisos', 'Admin\PermitController@index');
	Route::post('/permisos', 'Admin\PermitController@store');
	Route::get('/permisos/{id}', 'Admin\PermitController@edit');
	Route::post('/permisos/{id}', 'Admin\PermitController@update');

//['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.']


Route::group(['middleware' => ['auth','permisos']], function(){

    
	//Incidents
	//Create Incidents
	Route::get('/reportar', [
	    'as' => 'reportar.create',
        'uses' => 'IncidentController@create'
    ]);
	Route::post('/reportar', [
	    'as' => 'reportar.store',
        'uses' => 'IncidentController@store'
    ]);
	Route::get('/incidencia/{id}/editar', [
	    'as' => 'incidencia.edit',
        'uses' => 'IncidentController@edit'
    ]);
	Route::post('/incidencia/{id}/editar', [
	    'as' => 'ver.index',
        'uses' => 'IncidentController@update'
    ]);
	Route::get('/ver/{id}', [
	    'as' => 'ver.show',
        'uses' => 'IncidentController@show'
    ]);
	Route::get('/ver', [
	    'as' => 'ver.index',
        'uses' => 'IncidentController@index'
    ]);
	Route::post('/ver/asignar', 'IncidentController@assign');
	Route::post('/ver/reasignar', 'IncidentController@reassign');

	Route::get('/incidencia/{id}/atender', 'IncidentController@take');
	Route::get('/incidencia/{id}/resolver', 'IncidentController@solve');
	Route::get('/incidencia/{id}/abrir', 'IncidentController@open');
	Route::get('/incidencia/{id}/derivar', 'IncidentController@nextLevel');


	//Messages
	Route::post('/mensajes','MessageController@store');

	//Calendar Asignament
	Route::get('/calendario', function () {
		return view('calendar');
	});
	//statistics charts
	Route::get('/estadisticas', function () {
		return view('statistics');
	});

	//User
	Route::get('/usuarios', [
	    'as' => 'usuarios.index',
        'uses' => 'Admin\UserController@index'
    ]);
	Route::post('/usuarios', 'Admin\UserController@store');

	Route::get('/usuarios/{id}', 'Admin\UserController@edit');
	Route::post('/usuarios/{id}', 'Admin\UserController@update');
	Route::get('/usuarios/{id}/eliminar', 'Admin\UserController@delete');
	
	//Profiles
	Route::get('/perfiles', [
	    'as' => 'perfiles.index',
        'uses' => 'Admin\ProfileController@index'
    ]);
	Route::post('/perfiles', 'Admin\ProfileController@store');
	Route::post('/perfiles/editar', 'Admin\ProfileController@update');
	Route::get('/perfiles/{id}/eliminar', 'Admin\ProfileController@delete');
	Route::get('/perfiles/{id}/restaurar', 'Admin\ProfileController@restore');

	//Menu
	Route::get('/opciones', [
	    'as' => 'opciones.index',
        'uses' => 'Admin\MenuController@index'
    ]);
	Route::post('/opciones', 'Admin\MenuController@store');
	Route::get('/opciones/{id}', 'Admin\MenuController@edit');
	Route::post('/opciones/{id}', 'Admin\MenuController@update');
	Route::get('/opciones/{id}/eliminar', 'Admin\MenuController@delete');
	Route::get('/opciones/hijos/{id}', 'Admin\MenuController@gethijos');

		


	//Project
	Route::get('/proyectos', [
	    'as' => 'proyectos.index',
        'uses' => 'Admin\ProjectController@index'
    ]);
	Route::post('/proyectos', 'Admin\ProjectController@store');

	Route::get('/proyectos/{id}', 'Admin\ProjectController@edit');
	Route::post('/proyectos/{id}', 'Admin\ProjectController@update');
	Route::get('/proyectos/{id}/eliminar', 'Admin\ProjectController@delete');
	Route::get('/proyectos/{id}/restaurar', 'Admin\ProjectController@restore');

	//Category
	Route::post('/categorias', 'Admin\CategoryController@store');
	Route::post('/categorias/editar', 'Admin\CategoryController@update');
	Route::get('/categorias/{id}/eliminar', 'Admin\CategoryController@delete');

	

	//Level
	Route::post('/niveles', 'Admin\LevelController@store');
	Route::post('/niveles/editar', 'Admin\LevelController@update');
	Route::get('/niveles/{id}/eliminar', 'Admin\LevelController@delete');

	//Project-User
	Route::post('/proyecto-usuario', 'Admin\ProjectUserController@store');
	Route::get('/proyecto-usuario/{id}/eliminar', 'Admin\ProjectUserController@delete');
	
	//Config
	Route::get('/config', 'ConfigController@index');

});


Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');
