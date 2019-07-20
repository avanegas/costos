<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\User;

$factory->define(User::class, function (Faker $faker) {
    static $password;
    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'password'          => 'secret',
        'remember_token'    => Str::random(60),
    ];
});
