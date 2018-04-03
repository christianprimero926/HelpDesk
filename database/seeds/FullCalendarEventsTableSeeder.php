<?php

use Illuminate\Database\Seeder;

class FullCalendarEventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\FullCalendarEvent::class)
        ->times(100)
        ->create();
    }
}
