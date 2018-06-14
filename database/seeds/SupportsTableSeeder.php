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
        ]);User::create([
            'name' => 'Soporte S3',
            'email' => 'support3@hotmail.com',
            'password' => bcrypt('1234567'),
            'profile_id' => 2
        ]);
        User::create([
            'name' => 'Soporte S4',
            'email' => 'support4@hotmail.com',
            'password' => bcrypt('1234567'),
            'profile_id' => 2
        ]);User::create([
            'name' => 'Soporte S5',
            'email' => 'support5@hotmail.com',
            'password' => bcrypt('1234567'),
            'profile_id' => 2
        ]);
        User::create([
            'name' => 'Soporte S6',
            'email' => 'support6@hotmail.com',
            'password' => bcrypt('1234567'),
            'profile_id' => 2
        ]);User::create([
            'name' => 'Soporte S7',
            'email' => 'support7@hotmail.com',
            'password' => bcrypt('1234567'),
            'profile_id' => 2
        ]);
        User::create([
            'name' => 'Soporte S8',
            'email' => 'support8@hotmail.com',
            'password' => bcrypt('1234567'),
            'profile_id' => 2
        ]);

    }
}
