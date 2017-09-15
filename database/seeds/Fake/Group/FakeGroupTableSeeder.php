<?php

use Illuminate\Database\Seeder;

class FakeGroupTableSeeder extends Seeder
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
        factory(\App\Models\Education\Group\Group::class, 100)->create();
    }
}