<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        User::create([
        	'name' => 'Christian',
        	'email' => 'admin@hotmail.com',
        	'password' => bcrypt('19972000'),
        	'profile_id' => 1
        ]);
        User::create([
            'name' => 'Soporte S1',
            'email' => 'support1@hotmail.com',
            'password' => bcrypt('1234567'),
            'profile_id' => 2,
            'selected_project_id' => 1
        ]);
        //Client
        factory(App\User::class)
        ->times(60)
        ->create();
        //Client 1
                 
        
    }
}
