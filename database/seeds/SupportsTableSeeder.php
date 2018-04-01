<?php

use Illuminate\Database\Seeder;
use App\User;

class SupportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //Support
        User::create([
            'name' => 'Soporte S1',
            'email' => 'support1@hotmail.com',
            'password' => bcrypt('1234567'),
            'profile_id' => 2
        ]);

        User::create([
            'name' => 'Soporte S2',
            'email' => 'support2@hotmail.com',
            'password' => bcrypt('1234567'),
            'profile_id' => 2
        ]);
    }
}
