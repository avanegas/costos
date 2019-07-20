<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Post\Post;

$factory->define(Post::class, function (Faker $faker) {

    $title = $faker->sentence(2, true);
    
    return [
        'user_id' 		=> rand(1,10),
        'category_id' 	=> rand(1,10),
        'name' 			=> $title,
        'slug' 			=> Str::slug($title),
        'excerpt' 		=> $faker->text(150),
        'body' 			=> $faker->text(300),
        'file' 			=> 'test.png',
        'status'        => $faker->randomElement(['DRAFT', 'PUBLISHED']),
    ];
});
