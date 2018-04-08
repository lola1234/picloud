<?php

use Faker\Generator as Faker;

$factory->define(App\Pic::class, function (Faker $faker) {
    return [
        'picimg'=>'uploads/apicture.jpeg'
    ];
});
