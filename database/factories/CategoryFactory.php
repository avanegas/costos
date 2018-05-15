<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post\Category::class, function (Faker $faker) {
    return [
        'name' => $title,
        'slug' => str_slug($title),
        'body' => $faker->text(200),
    ];
});
