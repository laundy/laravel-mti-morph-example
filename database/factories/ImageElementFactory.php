<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ImageElement;
use Faker\Generator as Faker;

$factory->define(ImageElement::class, function (Faker $faker) {
    return [
        'format' => $faker->randomNumber(4),
        'height' => $faker->randomFloat(2, 0, 5000),
        'width' => $faker->randomFloat(2, 0, 5000),
    ];
});
