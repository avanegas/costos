<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Models\Oferta\Oferta;

$factory->define(Oferta::class, function (Faker $faker) {
    return [
            'user_id'		=> rand(1, 10),
            'name'			=> $faker->sentence(4, true),
            'unidad'		=> $faker->word,
            'descripcion'	=> $faker->sentence(6, true),
            'stock'			=> rand(1,10),
            'precio'		=> randomFloat( 2, 10, 100),
            'file'			=> 'oferta.png',
            'status'        => TRUE
    ];
});
