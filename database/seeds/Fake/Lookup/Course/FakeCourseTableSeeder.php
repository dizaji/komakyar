<?php

use Illuminate\Database\Seeder;

class FakeCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generatePresentation = function (\App\Models\Education\Course\Course $course) {
            /** @var Faker\Generator $faker */
            $faker = resolve(Faker\Generator::class);

            \App\Models\User\Teacher\Teacher::query()
                ->inRandomOrder()
                ->take($faker->numberBetween(0, \App\Models\User\Teacher\Teacher::query()->count()))
                ->get()
                ->each(function ($teacher) use ($course) {
                    $course->presentations()->save(new \App\Models\Education\Course\Presentation([
                        'teacher_id' => $teacher->id,
                    ]));
                });
        };

        factory(\App\Models\Education\Course\Course::class, 100)->create()
            ->each($generatePresentation);
        factory(\App\Models\Education\Course\Course::class, 100, 'null')->create()
            ->each($generatePresentation);
    }
}