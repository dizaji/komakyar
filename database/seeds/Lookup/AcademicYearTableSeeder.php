<?php

use Illuminate\Database\Seeder;

class AcademicYearTableSeeder extends Seeder
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
        \App\Models\AcademicYear::create([
            'year' => 1396,
            'title' => 'سال تحصیلی 1396-1397',
            'is_selected' => true,
        ]);
    }
}
