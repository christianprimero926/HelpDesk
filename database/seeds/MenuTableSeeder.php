<?php

use Illuminate\Database\Seeder;
use App\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //1               
        Menu::create([
        	'name' => 'Ver incidencias',
        	'src' => 'ver',
        	'orden' => 1,
        	'icon' => 'fa fa-book',
        	'id_padre' => 0,
            'as' => "Ver incidencias",
            'show' => 1
        ]);
    //2
        Menu::create([
            'name' => 'Reportar incidencias',
            'src' => 'reportar',
            'orden' => 2,
            'icon' => 'fa fa-edit',
            'id_padre' => 0,
            'as' => "Reportar incidencias",
            'show' => 1
        ]);
        /*
        Menu::create([
            'name' => 'Calendario de Asignaciones',
            'src' => 'calendario',
            'orden' => 3,
            'icon' => 'fa fa-calendar',
            'id_padre' => 0
        ]);
        */
    //3        
        Menu::create([
        	'name' => 'Administración',
        	'src' => '#',
        	'orden' => 3,
        	'icon' => 'fa fa-user-circle',
        	'id_padre' => 0,            
            'show' => 1
        ]);
    //4
        Menu::create([
        	'name' => 'Proyectos',
        	'src' => 'proyectos',
        	'orden' => 1,
        	'icon' => 'fa fa-folder-open',
        	'id_padre' => 3,
            'as' => 'Proyectos',
            'show' => 1
        ]);
    //5
        Menu::create([
            'name' => 'Menú',
            'src' => 'opciones',
            'orden' => 2,
            'icon' => 'fa fa-bars',
            'id_padre' => 3,
            'as' => 'Menú',
            'show' => 1
        ]);
    //6
        Menu::create([
        	'name' => 'Usuarios',
        	'src' => '#',
        	'orden' => 3,
        	'icon' => 'fa fa-users',
        	'id_padre' => 3,
            'show' => 1
        ]);
    //7
        Menu::create([
        	'name' => 'Permisos',
        	'src' => 'permisos',
        	'orden' => 1,
        	'icon' => 'fa fa-key',
        	'id_padre' => 6,
            'as' => 'Permisos',
            'show' => 1
        ]);
    //8
        Menu::create([
        	'name' => 'Roles de usuarios',
        	'src' => 'perfiles',
        	'orden' => 2,
        	'icon' => 'fa fa-address-card',
        	'id_padre' => 6,
            'as' => 'Roles de usuarios',
            'show' => 1
        ]);
    //9
        Menu::create([
        	'name' => 'Creación de usuarios',
        	'src' => 'usuarios',
        	'orden' => 3,
        	'icon' => 'fa fa-user-plus',
        	'id_padre' => 6,
            'as' => 'Creación de usuarios',
            'show' => 1
        ]);
    //10
        Menu::create([
            'name' => 'Reportes y Estadisticas',
            'src' => 'estadisticas',
            'orden' => 4,
            'icon' => 'fa fa-pie-chart',
            'id_padre' => 0,
            'as' => 'Reportes y Estadisticas',
            'show' => 1
        ]);        
    //11
        Menu::create([
            'name' => 'Opciones incidencias',
            'src' => '#',
            'orden' => 0,
            'icon' => '#',
            'id_padre' => 0,            
            'show' => 0            
        ]);
    //12
        Menu::create([
            'name' => 'reasignar incidencia',
            'src' => 'ver/reasignar',
            'orden' => 1,
            'icon' => '#',
            'id_padre' => 11,
            'as' => 'ver.reasignar',
            'show' => 0
        ]);
    //13
        Menu::create([
            'name' => 'almacenar incidencias',
            'src' => 'reportar',
            'orden' => 2,
            'icon' => '#',            
            'id_padre' => 11,
            'as' => 'reportar.store',
            'show' => 0            
        ]);
    //14
        Menu::create([
            'name' => 'editar incidencias',
            'src' => 'incidencia/{id}/editar',
            'orden' => 3,
            'icon' => '#',
            'id_padre' => 11,
            'as' => 'Editar incidencia',
            'show' => 0 
        ]);
    //15
        Menu::create([
            'name' => 'actualizar incidencias',
            'src' => 'incidencia/{id}/editar',
            'orden' => 4,
            'icon' => '#',
            'id_padre' => 11,
            'as' => 'incidencia.update',
            'show' => 0                                   
        ]);
    //16
        Menu::create([
            'name' => 'ver detalles de la incidencia',
            'src' => 'ver/{id}',
            'orden' => 5,
            'icon' => '#',
            'id_padre' => 11,
            'as' => 'Ver Detalles de la Incidencia',
            'show' => 0
        ]);
    //17
        Menu::create([
            'name' => 'asignar incidencia',
            'src' => 'ver/asignar',
            'orden' => 6,
            'icon' => '#',
            'id_padre' => 11,
            'as' => 'ver.assign',
            'show' => 0
        ]);
    //18        
        Menu::create([
            'name' => 'tomar incidencia',
            'src' => 'incidencia/{id}/atender',
            'orden' => 7,
            'icon' => '#',
            'id_padre' => 11,
            'as' => 'ver.take',
            'show' => 0
        ]);
    //19
        Menu::create([
            'name' => 'resolver incidencia',
            'src' => 'incidencia/{id}/resolver',
            'orden' => 8,
            'icon' => '#',
            'id_padre' => 11,
            'as' => 'ver.solve',
            'show' => 0
        ]);
    //20
        Menu::create([
            'name' => 'reabrir incidencia',
            'src' => 'incidencia/{id}/abrir',
            'orden' => 9,
            'icon' => '#',
            'id_padre' => 11,
            'as' => 'ver.open',
            'show' => 0
        ]);
    //21
        Menu::create([
            'name' => 'derivar incidencia',
            'src' => 'incidencia/{id}/derivar',
            'orden' => 10,
            'icon' => '#',
            'id_padre' => 11,
            'as' => 'ver.nextLevel',
            'show' => 0
        ]);
    //22        
        Menu::create([
            'name' => 'mensajes',
            'src' => 'mensajes',
            'orden' => 0,
            'icon' => '#',
            'id_padre' => 0,
            'as' => 'mensajes.store',
            'show' => 0
        ]);
    //23
        Menu::create([
            'name' => 'Opciones Permisos',
            'id_padre' => 0,
            'orden' => 6            
        ]);
    //24
        Menu::create([
            'name' => 'almacenar permisos',
            'src' => 'permisos',
            'orden' => 1,
            'icon' => '#',
            'id_padre' => 23,
            'as' => 'permisos.store',
            'show' => 0
        ]);
    //25        
        Menu::create([
            'name' => 'editar permisos',
            'src' => 'permisos/{id}',
            'orden' => 2,
            'icon' => '#',
            'id_padre' => 23,
            'as' => 'Editar permisos',            
            'show' => 0
                        
        ]);
    //26
        Menu::create([
            'name' => 'actualizar permisos',
            'src' => 'permisos/{id}',
            'orden' => 3,
            'icon' => '#',
            'id_padre' => 23,
            'as' => 'permisos.update',            
            'show' => 0
                        
        ]);
    //27
        Menu::create([
            'name' => 'Opciones usuario',
            'src' => '#',
            'orden' => 0,
            'icon' => '#',
            'id_padre' => 0,
            'show' => 0 
        ]);
    //28
        Menu::create([
            'name' => 'almacenar usuario',
            'src' => 'usuarios',
            'orden' => 1,
            'icon' => '#',
            'id_padre' => 27,
            'as' => 'usuarios.store',            
            'show' => 0                        
        ]);
    //29
        Menu::create([
            'name' => 'editar usuario',
            'src' => 'usuarios/{id}',
            'orden' => 2,
            'icon' => '#',
            'id_padre' => 27,
            'as' => 'Editar usuario',            
            'show' => 0                        
        ]);
    //30
        Menu::create([
            'name' => 'actualizar usuario',
            'src' => 'usuarios/{id}',
            'orden' => 3,
            'icon' => '#',
            'id_padre' => 27,
            'as' => 'usuarios.update',            
            'show' => 0                        
        ]);
    //31
        Menu::create([
            'name' => 'eliminar usuario',
            'src' => 'usuarios/{id}/eliminar',
            'orden' => 4,
            'icon' => '#',
            'id_padre' => 27,
            'as' => 'usuarios.delete',            
            'show' => 0                        
        ]);
    //32
        Menu::create([
            'name' => 'Opciones perfiles',
            'src' => '#',
            'orden' => 0,
            'icon' => '#',
            'id_padre' => 0,
            'show' => 0 
        ]);
    //33
        Menu::create([
            'name' => 'almacenar perfil',
            'src' => 'perfiles',
            'orden' => 1,
            'icon' => '#',
            'id_padre' => 32,
            'as' => 'perfiles.store',            
            'show' => 0                        
        ]);
    //34
        Menu::create([
            'name' => 'actualizar perfil',
            'src' => 'perfiles/editar',
            'orden' => 2,
            'icon' => '#',
            'id_padre' => 32,
            'as' => 'perfiles.update',            
            'show' => 0                        
        ]);
    //35
        Menu::create([
            'name' => 'eliminar perfil',
            'src' => 'perfiles/{id}/eliminar',
            'orden' => 3,
            'icon' => '#',
            'id_padre' => 32,
            'as' => 'perfiles.delete',            
            'show' => 0                        
        ]);
    //36
        Menu::create([
            'name' => 'restaurar perfil',
            'src' => 'perfiles/{id}/restaurar',
            'orden' => 4,
            'icon' => '#',
            'id_padre' => 32,
            'as' => 'perfiles.restore',            
            'show' => 0                        
        ]);
    //37
        Menu::create([
            'name' => 'Opciones Menu',
            'src' => '#',
            'orden' => 0,
            'icon' => '#',
            'id_padre' => 0,
            'show' => 0 
        ]);
    //38
        Menu::create([
            'name' => 'almacenar opciones',
            'src' => 'opciones',
            'orden' => 1,
            'icon' => '#',
            'id_padre' => 37,
            'as' => 'opciones.store',            
            'show' => 0                        
        ]);
    //39
        Menu::create([
            'name' => 'editar opciones',
            'src' => 'opciones/{id}',
            'orden' => 2,
            'icon' => '#',
            'id_padre' => 37,
            'as' => 'Editar opciones',            
            'show' => 0                        
        ]);
    //40
        Menu::create([
            'name' => 'actualizar opciones',
            'src' => 'opciones/{id}',
            'orden' => 3,
            'icon' => '#',
            'id_padre' => 37,
            'as' => 'opciones.update',            
            'show' => 0                        
        ]);
    //41
        Menu::create([
            'name' => 'eliminar opciones',
            'src' => 'opciones/{id}/eliminar',
            'orden' => 4,
            'icon' => '#',
            'id_padre' => 37,
            'as' => 'opciones.delete',            
            'show' => 0                        
        ]);
    //42
        Menu::create([
            'name' => 'obtener hijos opciones',
            'src' => 'opciones/hijos/{id}',
            'orden' => 5,
            'icon' => '#',
            'id_padre' => 37,
            'as' => 'opciones.gethijos',            
            'show' => 0                        
        ]);
    //43
        Menu::create([
            'name' => 'Opciones proyecto',
            'src' => '#',
            'orden' => 0,
            'icon' => '#',
            'id_padre' => 0,
            'show' => 0 
        ]);
    //44
        Menu::create([
            'name' => 'almacenar proyecto',
            'src' => 'proyectos',
            'orden' => 1,
            'icon' => '#',
            'id_padre' => 43,
            'as' => 'proyectos.store',            
            'show' => 0                        
        ]);
    //45
        Menu::create([
            'name' => 'editar proyecto',
            'src' => 'proyectos/{id}',
            'orden' => 2,
            'icon' => '#',
            'id_padre' => 43,
            'as' => 'Editar proyectos',            
            'show' => 0                        
        ]);
    //46
        Menu::create([
            'name' => 'actualizar proyecto',
            'src' => 'proyectos/{id}',
            'orden' => 3,
            'icon' => '#',
            'id_padre' => 43,
            'as' => 'proyectos.update',            
            'show' => 0                        
        ]);
    //47
        Menu::create([
            'name' => 'eliminar proyecto',
            'src' => 'proyectos/{id}/eliminar',
            'orden' => 4,
            'icon' => '#',
            'id_padre' => 43,
            'as' => 'proyectos.delete',            
            'show' => 0                        
        ]);
    //48
        Menu::create([
            'name' => 'restaurar proyecto',
            'src' => 'proyectos/{id}/restaurar',
            'orden' => 5,
            'icon' => '#',
            'id_padre' => 43,
            'as' => 'proyectos.restore',            
            'show' => 0                        
        ]);
    //49
        Menu::create([
            'name' => 'Opciones categorias',
            'src' => '#',
            'orden' => 0,
            'icon' => '#',
            'id_padre' => 0,
            'show' => 0 
        ]);
    //50
        Menu::create([
            'name' => 'almacenar categorias',
            'src' => 'categorias',
            'orden' => 1,
            'icon' => '#',
            'id_padre' => 49,
            'as' => 'categorias.store',            
            'show' => 0                        
        ]);
    //51
        Menu::create([
            'name' => 'actualizar categorias',
            'src' => 'categorias/editar',
            'orden' => 2,
            'icon' => '#',
            'id_padre' => 49,
            'as' => 'categorias.update',            
            'show' => 0                        
        ]);
    //52
        Menu::create([
            'name' => 'eliminar categorias',
            'src' => 'categorias/{id}/eliminar',
            'orden' => 3,
            'icon' => '#',
            'id_padre' => 49,
            'as' => 'categorias.delete',            
            'show' => 0                        
        ]);
    //53
        Menu::create([
            'name' => 'Opciones niveles',
            'src' => '#',
            'orden' => 0,
            'icon' => '#',
            'id_padre' => 0,
            'show' => 0 
        ]);
    //54
        Menu::create([
            'name' => 'almacenar niveles',
            'src' => 'niveles',
            'orden' => 1,
            'icon' => '#',
            'id_padre' => 53,
            'as' => 'niveles.store',            
            'show' => 0                        
        ]);
    //55
        Menu::create([
            'name' => 'actualizar niveles',
            'src' => 'niveles/editar',
            'orden' => 2,
            'icon' => '#',
            'id_padre' => 53,
            'as' => 'niveles.update',            
            'show' => 0                        
        ]);
    //56
        Menu::create([
            'name' => 'eliminar niveles',
            'src' => 'niveles/{id}/eliminar',
            'orden' => 3,
            'icon' => '#',
            'id_padre' => 53,
            'as' => 'niveles.delete',            
            'show' => 0                        
        ]);
    //57
        Menu::create([
            'name' => 'Opciones asignacion de proyectos',
            'src' => '#',
            'orden' => 0,
            'icon' => '#',
            'id_padre' => 0,
            'show' => 0 
        ]);
    //58
        Menu::create([
            'name' => 'asignar proyecto',
            'src' => 'proyecto-usuario',
            'orden' => 1,
            'icon' => '#',
            'id_padre' => 57,
            'as' => 'proyectos_usuario.store',            
            'show' => 0                        
        ]);
    //59
        Menu::create([
            'name' => 'eliminar asignacion de proyecto',
            'src' => 'proyecto-usuario/{id}/eliminar',
            'orden' => 2,
            'icon' => '#',
            'id_padre' => 57,
            'as' => 'proyectos_usuario.delete',            
            'show' => 0                        
        ]);
    //60
        Menu::create([
            'name' => 'Opciones ver graficos estadisticos',
            'src' => '#',
            'orden' => 0,
            'icon' => '#',
            'id_padre' => 0,
            'show' => 0 
        ]);
    //61
        Menu::create([
            'name' => 'ver reportes por mes',
            'src' => 'estadisticas/{anio}/{mes}',
            'orden' => 1,
            'icon' => '#',
            'id_padre' => 60,
            'as' => 'reportes.anio.mes',            
            'show' => 0                        
        ]);
    //62
        Menu::create([
            'name' => 'ver reportes de incidencias',
            'src' => 'estadisticas/incidencias/{anio}/{mes}',
            'orden' => 2,
            'icon' => '#',
            'id_padre' => 60,
            'as' => 'estadisticas.incidencias',            
            'show' => 0                        
        ]);
    //63
        Menu::create([
            'name' => 'ver reportes de modulos',
            'src' => 'estadisticas/modulos/{anio}/{mes}',
            'orden' => 3,
            'icon' => '#',
            'id_padre' => 60,
            'as' => 'estadisticas.modulos',            
            'show' => 0                        
        ]);
        Menu::create([            
            'name' => 'SIN PADRE',
            'src' => '#',
            'orden' => 0,
            'id_padre' => -1
        ]); 
    }
}
