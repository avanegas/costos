<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Models\Precio\GrupoPrecio;

$factory->define(GrupoPrecio::class, function (Faker $faker) {
    return [
        'zona_id'     => rand(1,10),
        'name'        => $faker->unique()->sentence(2, true),
        'description' => $faker->paragraph(mt_rand(1, 2))
    ];
});
