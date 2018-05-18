<?php

use Faker\Generator as Faker;

$factory->define(App\Currency::class, function (Faker $faker) {
    return [

        "name" => $faker->name(),
        "code" => $faker->name(),


    ];
});
