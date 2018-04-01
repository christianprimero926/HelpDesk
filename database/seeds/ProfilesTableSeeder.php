<?php

use Illuminate\Database\Seeder;
use App\Profile;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::create([
        	'name' => 'Administrador'        	
        ]);
        Profile::create([
        	'name' => 'Desarrollador'        	
        ]);
        Profile::create([
            'name' => 'Cliente'          
        ]);
        Profile::create([
            'name' => 'Secretaria'          
        ]);
        Profile::create([
            'name' => 'Jefe de Bodega'          
        ]);
        Profile::create([
            'name' => 'Contador'          
        ]);
        Profile::create([
        	'name' => 'Ingeniero'        	
        ]); 
    }
}
