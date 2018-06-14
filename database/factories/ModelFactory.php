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

/**
 * Factory para los proyectos
 * @param type App\Project::class 
 * @param function (Faker\Generator $faker 
 * @return type
 */
$factory->define(App\Project::class, function (Faker\Generator $faker) {
     return [
         'name' => $faker->company,
         'description' => $faker->text         
     ];
}); 
//departmentName
/**
 * Factory para las categorias
 * @param type App\Category::class 
 * @param function (Faker\Generator $faker 
 * @return type
 */
$factory->define(App\Category::class, function (Faker\Generator $faker) {
     return [
         'name' => $faker->catchPhrase,
         'project_id' => $faker->numberBetween($min = 1, $max = 20)         
     ];
});

/**
  * Factory de niveles
  * @param type App\Level::class 
  * @param function (Faker\Generator $faker 
  * @return type
  */ 
$factory->define(App\Level::class, function (Faker\Generator $faker) {
     return [
         'name' => $faker->catchPhrase,
         'project_id' => $faker->numberBetween($min = 1, $max = 20)         
     ];
}); 
/**
    * Factory de los clientes
    * @param type App\User::class 
    * @param function (Faker\Generator $faker 
    * @return type
    */   
$factory->define(App\User::class, function (Faker\Generator $faker) {
     static $password;

     return [
         'name' => $faker->name,
         'email' => $faker->unique()->safeEmail,
         'password' => $password ?: $password = bcrypt('secret'),
         'remember_token' => str_random(10),
         'profile_id' =>  3
     ];
});

/**
 * Factory de Project-user
 * @param type App\ProjectUser::class 
 * @param function (Faker\Generator $faker 
 * @return type
 */
$factory->define(App\ProjectUser::class, function (Faker\Generator $faker) {
     return [
         'project_id' => $faker->numberBetween($min = 1, $max = 20),
         'user_id' => $faker->numberBetween($min = 2, $max = 9),
         'level_id' => $faker->numberBetween($min = 1, $max = 10)
         
     ];
});

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
//$faker->numberBetween($min = 1000, $max = 9000);
/**
 * Description
 * @param type App\FullCalendarEvent::class 
 * @param function (Faker\Generator $faker 
 * @return type
 */
$factory->define(App\Incident::class, function (Faker\Generator $faker) {

    return [
    	'title' => $faker->sentence(3),
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'severity' => 'M', 

        'category_id' => $faker->numberBetween($min = 1, $max = 10),
        'project_id' => $faker->numberBetween($min = 1, $max = 20),
        'level_id' => $faker->numberBetween($min = 1, $max = 10),

        'client_id' => $faker->numberBetween($min = 1, $max = 60),
        'support_id' => $faker->numberBetween($min = 2, $max = 9)
    ];
});