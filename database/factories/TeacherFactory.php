<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\User\Teacher\Teacher::class, function (Faker\Generator $faker) {
    return [
        'degree' => $faker->randomElements(['below diploma', 'diploma', 'BsC', 'MsC', 'PhD', 'Other', null]),
        'field_of_study' => $faker->text(3),
        'description' => $faker->text(),
        'is_visible' => $faker->boolean(90),
    ];
});