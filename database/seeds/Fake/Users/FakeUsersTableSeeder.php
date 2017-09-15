<?php

use Illuminate\Database\Seeder;

class FakeUsersTableSeeder extends Seeder
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
                    $student = factory(\App\Models\User\Student::class)->make();
                    $user->student()->save($student);
                }
                if ($user->is_teacher) {
                    $teacher = factory(\App\Models\User\Teacher\Teacher::class)->make();
                    $user->teacher()->save($teacher);
                }
                if ($user->is_staff) {
                    $staff = factory(\App\Models\User\Staff::class)->make();
                    $user->staff()->save($staff);
                }
            });
    }
}
