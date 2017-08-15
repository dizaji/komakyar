<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    $user_type = $faker->randomElements(['student', 'teacher', 'staff']);
    return [
        'first_name' => $faker->firstName,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'is_student' => $user_type == 'student',
        'is_teacher' => $user_type == 'teacher',
        'is_staff' => $user_type == 'staff',
        'is_parent' => false,
        'profile_picture' => $faker->imageUrl(150,150,'people'),
        'description' => $faker->text,
    ];
});
