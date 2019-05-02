<?php

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(30),
        'body' => $faker->realText(100),
    ];
});
