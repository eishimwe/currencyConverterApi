<?php

use Faker\Generator as Faker;

$factory->define(App\CurrencyRate::class, function (Faker $faker) {
    return [

        'from_currency_id' => function(){

           return factory(App\Currency::class)->create()->id;
        },
        'to_currency_id' => function(){

            return factory(App\Currency::class)->create()->id;
        },
        'rate'  => $faker->randomNumber(),
    ];
});
