<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post\Post::class, function (Faker $faker) {

    $title = $faker->sentence(6, true);
    
    return [
        'user_id' 		=> rand(1,10),
        'category_id' 	=> rand(1,10),
        'name' 			=> $title,
        'slug' 			=> str_slug($title),
        'excerpt' 		=> $faker->text(60),
        'body' 			=> $faker->text(200),
        'file' 			=> 'test.png',
        'status'        => $faker->randomElement(['DRAFT', 'PUBLISHED']),
    ];
});
