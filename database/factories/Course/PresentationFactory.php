<?php


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Education\Course\Presentation::class, function (Faker\Generator $faker) {
    return [
        'teacher_id' => \App\Models\User\Teacher\Teacher::query()->inRandomOrder()->first()->id,
        'course_id' => \App\Models\Education\Course\Course::query()->inRandomOrder()->first()->id,
        'description' => $faker->text(20),
    ];
});

$factory->define(\App\Models\Education\Course\Presentation::class, function (Faker\Generator $faker) {
    return [
        'teacher_id' => \App\Models\User\Teacher\Teacher::query()->inRandomOrder()->first()->id,
        'course_id' => \App\Models\Education\Course\Course::query()->inRandomOrder()->first()->id,
        'description' => null,
    ];
}, 'null');
