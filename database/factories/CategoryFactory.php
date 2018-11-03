<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post\Category::class, function (Faker $faker) {
	
	$title = $faker->sentence(2);

    return [
        'name' => $title,
        'slug' => str_slug($title),
        'body' => $faker->text(40),
    ];
});
