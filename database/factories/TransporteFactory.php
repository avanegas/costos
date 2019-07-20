<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Models\Data\Transporte;

$factory->define(Transporte::class, function (Faker $faker) {
    return [
        'zona_id' => rand(1,10),
        'name'    => $faker->unique()->sentence(2, true),
        'unidad'  => $faker->word,
        'tipo'    => $faker->word,
        'tarifa'  => $faker->randomFloat(5, 0.12345, 80),
    ];
});
