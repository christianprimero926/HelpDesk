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
        //Client
        factory(App\User::class)
        ->times(60)
        ->create();
    }
}
