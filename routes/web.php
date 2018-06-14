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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('Panel Principal');
Route::get('/seleccionar/proyecto/{id}', 'HomeController@selectProject');

Route::group(['middleware' => ['auth','permisos']], function(){
	
	//User Profile
	Route::get('/perfil', 'Admin\UserController@profile')->name('Perfil de Usuario');
    Route::post('perfil/{id}', 'Admin\UserController@update_perfil');
	
	//Permits
	Route::get('/permisos', 'Admin\PermitController@index')->name('Permisos');    
	Route::post('/permisos', 'Admin\PermitController@store')->name('permisos.store');
	
	Route::get('/permisos/{id}', 'Admin\PermitController@edit')->name('Editar permisos');
    Route::post('/permisos/{id}', 'Admin\PermitController@update')->name('permisos.update');    

	//Incidents
	//See Incidents
	Route::get('/ver', 'IncidentController@index')->name('Ver incidencias');
	Route::post('/ver/reasignar', 'IncidentController@reassign')->name('ver.reasignar');

	//Report Incident
	Route::get('/reportar', 'IncidentController@create')->name('Reportar incidencias');    
	Route::post('/reportar', 'IncidentController@store')->name('reportar.store');
	//Edit Incident
	Route::get('/incidencia/{id}/editar', 'IncidentController@edit')->name('Editar incidencia');
	Route::post('/incidencia/{id}/editar', 'IncidentController@update')->name('incidencia.update');
	
	//See incident
	Route::get('/ver/{id}', 'IncidentController@show')->name('Ver Detalles de la Incidencia');	
	Route::post('/ver/asignar', 'IncidentController@assign')->name('ver.assign');	
	Route::get('/incidencia/{id}/atender', 'IncidentController@take')->name('ver.take');
	Route::get('/incidencia/{id}/resolver', 'IncidentController@solve')->name('ver.solve');
	Route::get('/incidencia/{id}/abrir', 'IncidentController@open')->name('ver.open');
	Route::get('/incidencia/{id}/derivar', 'IncidentController@nextLevel')->name('ver.nextLevel');

	//Messages
	Route::post('/mensajes',[
		'as' => 'mensajes.store',
		'uses' => 'MessageController@store'
	]);
	/*
	//Calendar Asignament
	Route::get('/calendario', function () {
		return view('calendar');
	});
	*/

	//statistics charts
	Route::get('/estadisticas', 'GraficasController@index')->name('Reportes y Estadisticas');
	Route::get('/estadisticas/{anio}/{mes}', 'GraficasController@registros_mes')->name('reportes.anio.mes');
	Route::get('/estadisticas/incidencias/{anio}/{mes}', 'GraficasController@total_incidencias')->name('estadisticas.incidencias');
	Route::get('/estadisticas/modulos/{anio}/{mes}', 'GraficasController@total_modulos')->name('estadisticas.modulos');

	//User
	Route::get('/usuarios', [
	    'as' => 'Creación de usuarios',
        'uses' => 'Admin\UserController@index'
    ]);
	Route::post('/usuarios', [
		'as' => 'usuarios.store',
		'uses' => 'Admin\UserController@store'
	]);

	Route::get('/usuarios/{id}', [
		'as' => 'Editar usuario',
		'uses' => 'Admin\UserController@edit'
	]);	
	Route::post('/usuarios/{id}', [
		'as' => 'usuarios.update',
		'uses' => 'Admin\UserController@update'
	]);
	Route::get('/usuarios/{id}/eliminar', [
		'as' => 'usuarios.delete',
		'uses' => 'Admin\UserController@delete'
	]);

	//Profiles
	Route::get('/perfiles', [
	    'as' => 'Roles de usuarios',
        'uses' => 'Admin\ProfileController@index'
    ]);
	Route::post('/perfiles', [
		'as' => 'perfiles.store',
		'uses' => 'Admin\ProfileController@store'
	]);
	Route::post('/perfiles/editar', [
		'as' => 'perfiles.update',
		'uses' => 'Admin\ProfileController@update'
	]);
	Route::get('/perfiles/{id}/eliminar', [
		'as' => 'perfiles.delete',
		'uses' => 'Admin\ProfileController@delete'
	]);
	Route::get('/perfiles/{id}/restaurar', [
		'as' => 'perfiles.restore',
		'uses' => 'Admin\ProfileController@restore'
	]);

	//Menu
	Route::get('/opciones', [
	    'as' => 'Menú',
        'uses' => 'Admin\MenuController@index'
    ]);
	Route::post('/opciones', [
		'as' => 'opciones.store',
		'uses' => 'Admin\MenuController@store'
	]);
	Route::get('/opciones/{id}', [
		'as' => 'Editar opciones',
		'uses' => 'Admin\MenuController@edit'
	]);
	Route::post('/opciones/{id}', [
		'as' => 'opciones.update',
		'uses' => 'Admin\MenuController@update'
	]);
	Route::get('/opciones/{id}/eliminar', [
		'as' => 'opciones.delete',
		'uses' => 'Admin\MenuController@delete'
	]);
	Route::get('/opciones/hijos/{id}', [
		'as' => 'opciones.gethijos',
		'uses' => 'Admin\MenuController@gethijos'
	]);

	//Project
	Route::get('/proyectos', [
	    'as' => 'Proyectos',
        'uses' => 'Admin\ProjectController@index'
    ]);
	Route::post('/proyectos', [
		'as' => 'proyectos.store',
		'uses' => 'Admin\ProjectController@store'
	]);
	Route::get('/proyectos/{id}', [
		'as' => 'Editar proyectos',
		'uses' => 'Admin\ProjectController@edit'
	]);
	Route::post('/proyectos/{id}', [
		'as' => 'proyectos.update',
		'uses' => 'Admin\ProjectController@update'
	]);
	Route::get('/proyectos/{id}/eliminar', [
		'as' => 'proyectos.delete',
		'uses' => 'Admin\ProjectController@delete'
	]);
	Route::get('/proyectos/{id}/restaurar', [
		'as' => 'proyectos.restore',
		'uses' => 'Admin\ProjectController@restore'
	]);

	//Category
	Route::post('/categorias', [
		'as' => 'categorias.store',
		'uses' => 'Admin\CategoryController@store'
	]);
	Route::post('/categorias/editar', [
		'as' => 'categorias.update',
		'uses' => 'Admin\CategoryController@update'
	]);
	Route::get('/categorias/{id}/eliminar', [
		'as' => 'categorias.delete',
		'uses' => 'Admin\CategoryController@delete'
	]);	

	//Level
	Route::post('/niveles', [
		'as' => 'niveles.store',
		'uses' => 'Admin\LevelController@store'
	]);
	Route::post('/niveles/editar', [
		'as' => 'niveles.update',
		'uses' => 'Admin\LevelController@update'
	]);
	Route::get('/niveles/{id}/eliminar', [
		'as' => 'niveles.delete',
		'uses' => 'Admin\LevelController@delete'
	]);

	//Project-User
	Route::post('/proyecto-usuario', [
		'as' => 'proyectos_usuario.store',
		'uses' => 'Admin\ProjectUserController@store'
	]);
	Route::get('/proyecto-usuario/{id}/eliminar', [
		'as' => 'proyectos_usuario.delete',
		'uses' => 'Admin\ProjectUserController@delete'
	]);
	/**
	//Config
	Route::get('/config', [
		'as' => 'config.index',
		'uses' => 'ConfigController@index'
	]);	**/
});


Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');
