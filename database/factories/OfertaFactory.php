<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Oferta\Oferta::class, function (Faker $faker) {
    return [
            'user_id'		=>rand(1,10),
            'name'			=>$faker->sentence(4, true),
            'unidad'		=>$faker->word,
            'descripcion'	=>$faker->sentence(6, true),
            'stock'			=>rand(1,10),
            'precio'		=>randomFloat(2,10,100),
            'file'			=>'oferta.png'
            'status'		=>$faker->randomElement(['TRUE', 'FALSE']),
    ];
});
