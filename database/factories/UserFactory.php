<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'surname' => str_random(10),
        'role_id' => rand(1,3),
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'), // secret
        'remember_token' => str_random(10),
    ];
});
