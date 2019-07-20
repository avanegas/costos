<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Post\Category;

$factory->define(Category::class, function (Faker $faker) {
	
	$title = $faker->sentence(2, true);

    return [
        'name' => $title,
        'slug' => Str::slug($title),
        'body' => $faker->text(40),
    ];
});
