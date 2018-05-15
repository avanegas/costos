<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post\Tag::class, function (Faker $faker) {
    return [
        'name' => $title,
        'slug' => str_slug($title),
    ];
});
