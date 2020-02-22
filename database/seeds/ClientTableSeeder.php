<?php

use Illuminate\Database\Seeder;
use App\User;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Cliente',
            'email' => 'cliente@mail.com',
            'password' => bcrypt('1234567'),
        ]);
        //Client
        factory(App\User::class)
        ->times(60)
        ->create();
    }
}
