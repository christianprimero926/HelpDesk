<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProfilesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);        
        $this->call(LevelsTableSeeder::class);
        $this->call(SupportsTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(ProjectsUserTableSeeder::class);
        $this->call(IncidentsTableSeeder::class);
        $this->call(FullCalendarEventsTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(PermitTableSeeder::class);        
        $this->call(PermitSupportSeeder::class);
        $this->call(PermitClientTableSeeder::class);

    }
}
