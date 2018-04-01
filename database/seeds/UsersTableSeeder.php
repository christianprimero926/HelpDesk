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
        	'email' => 'christianprimero26@hotmail.com',
        	'password' => bcrypt('19972000'),
        	'profile_id' => 1
        ]);
        //Client 1
        User::create([
            'name' => 'Claudia',
            'email' => 'client@hotmail.com',
            'password' => bcrypt('1234567'),
            'profile_id' => 3
        ]);         
        
    }
}
