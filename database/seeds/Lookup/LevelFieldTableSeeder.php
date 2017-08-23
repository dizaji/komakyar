<?php

use Illuminate\Database\Seeder;

class LevelFieldTableSeeder extends Seeder
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
        $math = \App\Models\Lookup\Field::create(['title' => 'ریاضی']);
        $science = \App\Models\Lookup\Field::create(['title' => 'علوم تجربی']);
        $humanities = \App\Models\Lookup\Field::create(['title' => 'علوم انسانی']);
        $general = \App\Models\Lookup\Field::create(['title' => 'عمومی']);

        $first = \App\Models\Lookup\Level::create(['title' => 'اول ابتدایی']);
        $second = \App\Models\Lookup\Level::create(['title' => 'دوم ابتدایی']);
        $third = \App\Models\Lookup\Level::create(['title' => 'سوم ابتدایی']);
        $fourth = \App\Models\Lookup\Level::create(['title' => 'چهارم ابتدایی']);
        $fifth = \App\Models\Lookup\Level::create(['title' => 'پنجم ابتدایی']);
        $sixth = \App\Models\Lookup\Level::create(['title' => 'ششم ابتدایی']);
        $seventh = \App\Models\Lookup\Level::create(['title' => 'هفتم متوسطه']);
        $eighth = \App\Models\Lookup\Level::create(['title' => 'هشتم متوسطه']);
        $ninth = \App\Models\Lookup\Level::create(['title' => 'نهم متوسطه']);
        $tenth = \App\Models\Lookup\Level::create(['title' => 'دهم متوسطه']);
        $eleventh = \App\Models\Lookup\Level::create(['title' => 'یازدهم متوسطه']);
        $twelfth = \App\Models\Lookup\Level::create(['title' => 'دوازدهم متوسطه']);

        $first_general = \App\Models\LevelField::create([
            'level_id' => $first->id,
            'field_id' => $general->id,
            'parent_id' => null,
        ]);
        $second_general = \App\Models\LevelField::create([
            'level_id' => $second->id,
            'field_id' => $general->id,
            'parent_id' => $first_general->id,
        ]);
        $third_general = \App\Models\LevelField::create([
            'level_id' => $third->id,
            'field_id' => $general->id,
            'parent_id' => $second_general->id,
        ]);
        $fourth_general = \App\Models\LevelField::create([
            'level_id' => $fourth->id,
            'field_id' => $general->id,
            'parent_id' => $third_general->id,
        ]);
        $fifth_general = \App\Models\LevelField::create([
            'level_id' => $fifth->id,
            'field_id' => $general->id,
            'parent_id' => $fourth_general->id,
        ]);
        $sixth_general = \App\Models\LevelField::create([
            'level_id' => $sixth->id,
            'field_id' => $general->id,
            'parent_id' => $fifth_general->id,
        ]);
        $seventh_general = \App\Models\LevelField::create([
            'level_id' => $seventh->id,
            'field_id' => $general->id,
            'parent_id' => $sixth_general->id,
            'is_visible' => true,
        ]);
        $eighth_general = \App\Models\LevelField::create([
            'level_id' => $eighth->id,
            'field_id' => $general->id,
            'parent_id' => $seventh_general->id,
            'is_visible' => true,
        ]);
        $ninth_general = \App\Models\LevelField::create([
            'level_id' => $ninth->id,
            'field_id' => $general->id,
            'parent_id' => $eighth_general->id,
            'is_visible' => true,
        ]);

        $tenth_math = \App\Models\LevelField::create([
            'level_id' => $tenth->id,
            'field_id' => $math->id,
            'parent_id' => $ninth_general->id,
            'is_visible' => true,
        ]);
        $tenth_science = \App\Models\LevelField::create([
            'level_id' => $tenth->id,
            'field_id' => $science->id,
            'parent_id' => $ninth_general->id,
            'is_visible' => true,
        ]);
        $tenth_humanithies = \App\Models\LevelField::create([
            'level_id' => $tenth->id,
            'field_id' => $humanities->id,
            'parent_id' => $ninth_general->id,
            'is_visible' => true,
        ]);

        $eleventh_math = \App\Models\LevelField::create([
            'level_id' => $eleventh->id,
            'field_id' => $math->id,
            'parent_id' => $tenth_math->id,
            'is_visible' => true,
        ]);
        $eleventh_science = \App\Models\LevelField::create([
            'level_id' => $eleventh->id,
            'field_id' => $science->id,
            'parent_id' => $tenth_science->id,
            'is_visible' => true,
        ]);
        $eleventh_humanithies = \App\Models\LevelField::create([
            'level_id' => $eleventh->id,
            'field_id' => $humanities->id,
            'parent_id' => $tenth_humanithies->id,
            'is_visible' => true,
        ]);

        $twelfth_math = \App\Models\LevelField::create([
            'level_id' => $twelfth->id,
            'field_id' => $math->id,
            'parent_id' => $eleventh_math->id,
            'is_visible' => true,
        ]);
        $twelfth_science = \App\Models\LevelField::create([
            'level_id' => $twelfth->id,
            'field_id' => $science->id,
            'parent_id' => $eleventh_science->id,
            'is_visible' => true,
        ]);
        $twelfth_humanithies = \App\Models\LevelField::create([
            'level_id' => $twelfth->id,
            'field_id' => $humanities->id,
            'parent_id' => $eleventh_humanithies->id,
            'is_visible' => true,
        ]);
    }
}
