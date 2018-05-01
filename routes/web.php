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
//Calendar Asignament
Route::get('/calendario', function () {
    return view('calendar');
});
//statistics charts
Route::get('/estadisticas', function () {
    return view('statistics');
});
//Mailbox
Route::get('/correo', function () {
    return view('mailbox');
});//New E-mail
Route::get('/correo/nuevo', function () {
    return view('newmail');
});//Read E-mail
Route::get('/correo/leer', function () {
    return view('readmail');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/seleccionar/proyecto/{id}', 'HomeController@selectProject');


//Incidents
	//Create Incidents
Route::get('/reportar', 'IncidentController@create');
Route::post('/reportar', 'IncidentController@store');

Route::get('/incidencia/{id}/editar', 'IncidentController@edit');
Route::post('/incidencia/{id}/editar', 'IncidentController@update');

Route::get('/ver/{id}', 'IncidentController@show');

Route::get('/incidencia/{id}/atender', 'IncidentController@take');
Route::get('/incidencia/{id}/resolver', 'IncidentController@solve');
Route::get('/incidencia/{id}/abrir', 'IncidentController@open');
Route::get('/incidencia/{id}/derivar', 'IncidentController@nextLevel');

//Messages
Route::post('/mensajes','MessageController@store');



//['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.']


Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function(){

	//User
	Route::get('/usuarios', 'UserController@index');
	Route::post('/usuarios', 'UserController@store');

	Route::get('/usuarios/{id}', 'UserController@edit');
	Route::post('/usuarios/{id}', 'UserController@update');
	Route::get('/usuarios/{id}/eliminar', 'UserController@delete');
	
	//Profiles
	Route::get('/perfiles', 'ProfileController@index');
	Route::post('/perfiles', 'ProfileController@store');
	Route::post('/perfiles/editar', 'ProfileController@update');
	Route::get('/perfiles/{id}/eliminar', 'ProfileController@delete');
	Route::get('/perfiles/{id}/restaurar', 'ProfileController@restore');

	//Menu
	Route::get('/opciones', 'MenuController@index');
	Route::post('/opciones', 'MenuController@store');
	Route::get('/opciones/{id}', 'MenuController@edit');
	Route::post('/opciones/{id}', 'MenuController@update');
	Route::get('/opciones/{id}/eliminar', 'MenuController@delete');
	Route::get('/opciones/hijos/{id}', 'MenuController@gethijos');

	//Permits
	Route::get('/permisos', 'PermitController@index');
	Route::post('/permisos', 'PermitController@store');
	Route::get('/permisos/{id}', 'PermitController@edit');
	Route::post('/permisos/{id}', 'PermitController@update');	


	//Project
	Route::get('/proyectos', 'ProjectController@index');
	Route::post('/proyectos', 'ProjectController@store');

	Route::get('/proyectos/{id}', 'ProjectController@edit');
	Route::post('/proyectos/{id}', 'ProjectController@update');
	Route::get('/proyectos/{id}/eliminar', 'ProjectController@delete');
	Route::get('/proyectos/{id}/restaurar', 'ProjectController@restore');

	//Category
	Route::post('/categorias', 'CategoryController@store');
	Route::post('/categorias/editar', 'CategoryController@update');
	Route::get('/categorias/{id}/eliminar', 'CategoryController@delete');

	

	//Level
	Route::post('/niveles', 'LevelController@store');
	Route::post('/niveles/editar', 'LevelController@update');
	Route::get('/niveles/{id}/eliminar', 'LevelController@delete');

	//Project-User
	Route::post('/proyecto-usuario', 'ProjectUserController@store');
	Route::get('/proyecto-usuario/{id}/eliminar', 'ProjectUserController@delete');
	
	//Config
	Route::get('/config', 'ConfigController@index');

});


Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');
