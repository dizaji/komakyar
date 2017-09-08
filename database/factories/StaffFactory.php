<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\User\Staff::class, function (Faker\Generator $faker) {
    return [
        'degree' => $faker->randomElement(\App\Models\User\Staff::DEGREES),
        'field_of_study' => $faker->text(20),
        'direct_no' => $faker->randomElement([$faker->phoneNumber, null]),
        'extension' => $faker->randomElement([$faker->randomNumber(3), null]),
        'description' => $faker->text(),
        'is_visible' => $faker->boolean(90),
    ];
});