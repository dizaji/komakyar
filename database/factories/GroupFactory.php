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
$factory->define(\App\Models\Education\Group\Group::class, function (Faker\Generator $faker) {

    return [
        'level_field_id' => \App\Models\LevelField::inRandomOrder()->first()->id,
        'academic_year_id' => 1,

        'title' => $faker->text(20),
    ];
});
