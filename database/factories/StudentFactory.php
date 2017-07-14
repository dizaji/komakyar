<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\User\Student::class, function (Faker\Generator $faker) {
    return [
        'student_code' => $faker->unique()->randomNumber(10),
        'date_of_birth' => $faker->date(),
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});