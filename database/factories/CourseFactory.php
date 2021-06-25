<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        
        'title'=>$faker->title,
        'description'=>$faker->sentence(30),
        'enrollmentKey'=> $faker->optional($weight = 0.5,$default = 'begin')->word,

    ];
});
