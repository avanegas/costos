<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post\Tag::class, function (Faker $faker) {

	$title = $faker->unique()->word(1);
	
    return [
        'name' => $title,
        'slug' => str_slug($title),
    ];
});
