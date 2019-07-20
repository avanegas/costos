<?php

use Faker\Generator as Faker;

$factory->define(App\Zona::class, function (Faker $faker) {
    return [
        'user_id'     => rand(1,10),
        'name'        => $faker->name,
        'description' => $faker->paragraph(mt_rand(1, 2)),

    ];
});
