<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Models\Precio\Precio;
use App\Models\Precio\PrecioEquipo;

$factory->define(Precio::class, function (Faker $faker) {
    return [
        'user_id'         => mt_rand(1, 10),
        'grupo_precio_id' => mt_rand(1, 10),
        'name'            => $faker->sentence(2,true),
        'unidad'          => $faker->word,
        'detalle'         => $faker->paragraph(mt_rand(1, 2)),
        'directo'         => $faker->randomFloat(5, 1.20, 120),
        'indirecto'       => 18,
    ];
});

$factory->afterCreating(Precio::class, function ($precio, $faker) {
    $precio->precio_equipos()->save(factory(PrecioEquipo::class)->make());
});

