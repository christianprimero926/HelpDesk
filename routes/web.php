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
	Route::get('/permisos', [
	    'as' => 'permisos.index',
        'uses' => 'Admin\PermitController@index'
    ]);
    
	Route::post('/permisos', 'Admin\PermitController@store');
	
	Route::get('/permisos/{id}', [
	    'as' => 'permisos.id.edit',
        'uses' => 'Admin\PermitController@edit'
    ]);
    Route::post('/permisos/{id}', 'Admin\PermitController@update');

    Route::get('/perfil', [
	    'as' => 'perfil.index',
        'uses' => 'Admin\UserController@profile'
    ]);
	



//['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.']


//Route::group(['middleware' => ['auth','permisos']], function(){
	

	//Incidents
	//Create Incidents
	Route::get('/ver', [
	    'as' => 'ver.index',
        'uses' => 'IncidentController@index'
    ]);
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
	    'as' => 'incidencia.update',
        'uses' => 'IncidentController@update'
    ]);
	Route::get('/ver/{id}', [
	    'as' => 'ver.show',
        'uses' => 'IncidentController@show'
    ]);	
	Route::post('/ver/asignar', [
		'as' => 'ver.assign',
		'uses' => 'IncidentController@assign'
	]);
	Route::post('/ver/reasignar', [
		'as' => 'ver.reassign',
		'uses' => 'IncidentController@reassign'
	]);
	Route::get('/incidencia/{id}/atender', [
		'as' => 'ver.take',
		'uses' => 'IncidentController@take'
	]);
	Route::get('/incidencia/{id}/resolver', [
		'as' => 'ver.solve',
		'uses' => 'IncidentController@solve'
	]);
	Route::get('/incidencia/{id}/abrir', [
		'as' => 'ver.open',
		'uses' => 'IncidentController@open'
	]);
	Route::get('/incidencia/{id}/derivar', [
		'as' => 'ver.nextLevel',
		'uses' => 'IncidentController@nextLevel'
	]);


	//Messages
	Route::post('/mensajes',[
		'as' => 'mensajes.store',
		'uses' => 'MessageController@store'
	]);

	//Calendar Asignament
	Route::get('/calendario', function () {
		return view('calendar');
	});

	//statistics charts
	Route::get('/estadisticas', 'GraficasController@index');
	Route::get('/estadisticas/{anio}/{mes}', 'GraficasController@registros_mes');
	Route::get('grafica_publicaciones', 'GraficasController@total_publicaciones');


	//User
	Route::get('/usuarios', [
	    'as' => 'usuarios.index',
        'uses' => 'Admin\UserController@index'
    ]);
	Route::post('/usuarios', [
		'as' => 'usuarios.store',
		'uses' => 'Admin\UserController@store'
	]);

	Route::get('/usuarios/{id}', [
		'as' => 'usuarios.edit',
		'uses' => 'Admin\UserController@edit'
	]);
	Route::post('perfil/{id}/avatar', 'Admin\UserController@update_avatar');
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
	    'as' => 'perfiles.index',
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
	    'as' => 'opciones.index',
        'uses' => 'Admin\MenuController@index'
    ]);
	Route::post('/opciones', [
		'as' => 'opciones.store',
		'uses' => 'Admin\MenuController@store'
	]);
	Route::get('/opciones/{id}', [
		'as' => 'opciones.edit',
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
	    'as' => 'proyectos.index',
        'uses' => 'Admin\ProjectController@index'
    ]);
	Route::post('/proyectos', [
		'as' => 'proyectos.store',
		'uses' => 'Admin\ProjectController@store'
	]);	

	Route::get('/proyectos/{id}', [
		'as' => 'proyectos.edit',
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
		'as' => 'proyectos-usuario.store',
		'uses' => 'Admin\ProjectUserController@store'
	]);
	Route::get('/proyecto-usuario/{id}/eliminar', [
		'as' => 'proyectos-usuario.delete',
		'uses' => 'Admin\ProjectUserController@delete'
	]);
	/**
	//Config
	Route::get('/config', [
		'as' => 'config.index',
		'uses' => 'ConfigController@index'
	]);
	**/

//});


Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');
