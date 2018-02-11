<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {

    $userArray = [];
    for ($i = 1; $i < 5; $i++) {
        array_push($userArray, $i);
    }
    return [
        'user_id' => '1',
        'category_id' => 1,
        'name' => $faker->sentence(2),
        'description' => $faker->realText(50),
        'type' => 'sell',
        'price' => $faker->numberBetween(1, 100),
        'trade' => null,
    ];
});
