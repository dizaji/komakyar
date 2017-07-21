<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public function __construct(\Faker\Generator $faker)
    {

        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 100)->create()
            ->each(function (\App\User $user) {
                if ($user->is_student) {
                    $user->student()->save(factory(\App\Models\User\Student::class)->create());
                }
                if ($user->is_teacher) {
                    $user->teacher()->save(factory(\App\Models\User\Teacher\Teacher::class)->create());
                }
                if ($user->is_staff) {
                    $user->staff()->save(factory(\App\Models\User\Staff::class)->create());
                }
            });
    }
}
