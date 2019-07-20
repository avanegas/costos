<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Models\Data\Equipo;

$factory->define(Equipo::class, function (Faker $faker) {
    return [
        'grupo_equipo_id' => rand(1,10),
        'name'            => $faker->unique()->sentence(2, true),
        'marca'           => $faker->sentence(2, true),
        'tipo'            => $faker->sentence(2, true),
        'tarifa'          => $faker->randomFloat(5, 0.1, 100),
    ];
});
