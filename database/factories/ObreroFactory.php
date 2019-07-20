<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Models\Data\Obrero;

$factory->define(Obrero::class, function (Faker $faker) {
    return [
        'grupo_obrero_id'   => rand(1,10),
        'name'              => $faker->unique()->sentence(2, true),
        'jornalhora'        => $faker->randomFloat(5, 1, 10),
        'factor'            => $faker->randomFloat(5, 2.12345, 3.54321)
    ];
});
