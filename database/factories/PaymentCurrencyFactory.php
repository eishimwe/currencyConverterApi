<?php

use Faker\Generator as Faker;

$factory->define(App\PaymentCurrency::class, function (Faker $faker) {
    return [

        'currency_id' => function(){

            return factory(App\Currency::class)->create()->id;
        }
    ];
});
