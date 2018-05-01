<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     static $password;

//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'password' => $password ?: $password = bcrypt('secret'),
//         'remember_token' => str_random(10),
//     ];
// });
/**
 * Event's Create 
 * @param type App\FullCalendarEvent::class 
 * @param function (Faker\Generator $faker 
 * @return type
 */
$factory->define(App\FullCalendarEvent::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence(4),
        'start' => $faker->dateTimeThisMonth(),
        'end' => $faker->dateTimeThisMonth(),
        'color' => $faker->hexColor
        
    ];
});
/**
 * Description
 * @param type App\FullCalendarEvent::class 
 * @param function (Faker\Generator $faker 
 * @return type
 */
$factory->define(App\Incident::class, function (Faker\Generator $faker) {

    return [
    	'title' => $faker->sentence(3),
        'description' => $faker->sentence(7),
        'severity' => 'N', 

        'category_id' => 2,
        'project_id' => 1,
        'level_id' => 1,

        'client_id' => 1,
        'support_id' => 3
    ];
});

