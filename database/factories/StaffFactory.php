<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\User\Student::class, function (Faker\Generator $faker) {
    return [
        'degree' => $faker->randomElements(['below diploma', 'diploma', 'BsC', 'MsC', 'PhD', 'Other', null]),
        'field_of_study' => $faker->text(3),
        'direct_no' => $faker->randomElements([$faker->phoneNumber, null]),
        'extension' => $faker->randomElements([$faker->randomNumber(3), null]),
        'description' => $faker->text(),
        'is_visible' => $faker->boolean(90),
    ];
});