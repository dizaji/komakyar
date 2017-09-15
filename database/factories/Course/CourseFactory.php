<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Education\Course\Course::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text(20),
        'multiplier' => $faker->numberBetween(1,4),
        'reference_name' => $faker->text(30),
        'reference_code' => $faker->numberBetween(100,100000),
    ];
});

$factory->define(\App\Models\Education\Course\Course::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text(20),
        'multiplier' => $faker->numberBetween(1,4),
        'reference_name' => null,
        'reference_code' => null,
    ];
}, 'null');
