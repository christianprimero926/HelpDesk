<?php

use Illuminate\Database\Seeder;
use App\ProjectUser;

class ProjectsUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Client
        factory(App\ProjectUser::class)
        ->times(20)
        ->create();       
    }
}
