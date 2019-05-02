<?php

use Faker\Generator as Faker;
use App\Answer;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->realText(100),
    ];
});
