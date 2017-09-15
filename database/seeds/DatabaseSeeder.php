<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LevelFieldTableSeeder::class);
        $this->call(AcademicYearTableSeeder::class);
        $this->call(UsersAdminSeeder::class);

        //fake
        $this->call(FakeGroupTableSeeder::class);
        $this->call(FakeUsersTableSeeder::class);
        $this->call(FakeCourseTableSeeder::class);
    }
}
