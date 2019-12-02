<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Element;
use App\TextElement;
use Faker\Generator as Faker;

function generateColor()
{
    $bytes = random_bytes(3);
    $bytes = bin2hex($bytes);

    return '#' . $bytes;
}

$factory->define(TextElement::class, function (Faker $faker) {
    return [
        'color' => generateColor(),
        'font' => $faker->text(20),
        'size' => $faker->randomFloat(0, 8, 26),
    ];
});
