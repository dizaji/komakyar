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

        //fake
        $this->call(StudentsTableSeeder::class);
        $this->call(GroupTableSeeder::class);
    }
}
