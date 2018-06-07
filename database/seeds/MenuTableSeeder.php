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
               
        Menu::create([
        	'name' => 'Ver incidencias',
        	'src' => 'ver',
        	'orden' => 1,
        	'icon' => 'fa fa-book',
        	'id_padre' => 0
        ]);
        
        Menu::create([
        	'name' => 'Reportar incidencias',
        	'src' => 'reportar',
        	'orden' => 2,
        	'icon' => 'fa fa-edit',
        	'id_padre' => 0
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
        Menu::create([
        	'name' => 'Estadisticas',
        	'src' => 'estadisticas',
        	'orden' => 3,
        	'icon' => 'fa fa-pie-chart',
        	'id_padre' => 0
        ]);
        Menu::create([
        	'name' => 'Administración',
        	'src' => '#',
        	'orden' => 4,
        	'icon' => 'fa fa-user-circle',
        	'id_padre' => 0
        ]);
        Menu::create([
        	'name' => 'Proyectos',
        	'src' => 'proyectos',
        	'orden' => 1,
        	'icon' => 'fa fa-folder-open',
        	'id_padre' => 4
        ]);
        Menu::create([
            'name' => 'Menú',
            'src' => 'opciones',
            'orden' => 2,
            'icon' => 'fa fa-bars',
            'id_padre' => 4
        ]);
        Menu::create([
        	'name' => 'Usuarios',
        	'src' => '#',
        	'orden' => 3,
        	'icon' => 'fa fa-users',
        	'id_padre' => 4
        ]);
        Menu::create([
        	'name' => 'Permisos',
        	'src' => 'permisos',
        	'orden' => 1,
        	'icon' => 'fa fa-key',
        	'id_padre' => 7
        ]);
        Menu::create([
        	'name' => 'Roles de usuarios',
        	'src' => 'perfiles',
        	'orden' => 2,
        	'icon' => 'fa fa-address-card',
        	'id_padre' => 7
        ]);
        Menu::create([
        	'name' => 'Creación de usuarios',
        	'src' => 'usuarios',
        	'orden' => 3,
        	'icon' => 'fa fa-user-plus',
        	'id_padre' => 7
        ]);        
        Menu::create([
        	'name' => 'Configuración',
        	'src' => 'config',
        	'orden' => 4,
        	'icon' => 'fa fa-cogs',
        	'id_padre' => 4
        ]);
        
        Menu::create([
        	'id' => 0,
        	'name' => 'SIN PADRE',
        	'src' => '#',
        	'orden' => 0,
        	'id_padre' => -1
        ]); 

    }
}
