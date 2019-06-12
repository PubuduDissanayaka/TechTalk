<?php

use Faker\Generator as Faker;

$factory->define(App\BlogPost::class, function (Faker $faker) {
    $dir = 'public/img/blog/cover/';
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'body' => $faker->paragraphs(rand(2,10),true),
        'user_id' => $faker->numberBetween($min = 1, $max = 32),
        'cat_id' => $faker->numberBetween($min = 1, $max = 21),
        'cover'=>$faker->image($dir, $width = 800, $height = 400, 'abstract', false),
        'views' => $faker->numberBetween($min = 30, $max = 150)
    ];
});
