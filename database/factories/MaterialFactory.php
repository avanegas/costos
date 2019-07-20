<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Models\Data\Material;

$factory->define(Material::class, function (Faker $faker) {
    return [
        'grupo_material_id' => rand(1,10),
        'name'              => $faker->unique()->sentence(2, true),
        'unidad'            => $faker->word,
        'precio'            => $faker->randomFloat(5, 0.1, 100),
    ];
});
