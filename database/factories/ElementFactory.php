<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Element;
use App\ImageElement;
use App\TextElement;
use Faker\Generator as Faker;

$types = ['BARCODE', 'IMAGE', 'LINE'];

$factory->define(Element::class, function (Faker $faker) use ($types) {
    $elementables = [
        ImageElement::class,
        TextElement::class,
    ];
    $elementableType = $faker->randomElement($elementables);
    $elementable = factory($elementableType)->create();
    return [
        'type' => $types[rand(0, count($types) - 1)],
        'x' => $faker->randomFloat(2, 0, 200),
        'y' => $faker->randomFloat(2, 0, 250),
        'elementable_id' => $elementable->id,
        'elementable_type' => $elementableType
    ];
});
