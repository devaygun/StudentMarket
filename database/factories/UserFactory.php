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
    static $password;

    $profile_pictures = ['demo_1.jpg','demo_2.jpg','demo_3.jpg','demo_4.jpg','demo_5.jpg','demo_6.jpg','demo_7.jpg','demo_8.jpg','demo_9.jpg','demo_10.jpg'];

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'date_of_birth' => $faker->dateTimeThisCentury,
//        'profile_picture' => "profiles/" . $profile_pictures[rand(0,8)], //array_rand($profile_pictures),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'api_token' => str_random(60),
    ];
});
