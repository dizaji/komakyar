<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('course_source_id');
            $table->unsignedInteger('level_field_id');
            $table->unsignedInteger('academic_year_id');

            $table->unsignedTinyInteger('multiplier')->default(0);
        });

        Schema::table('education_courses', function (Blueprint $table) {
            $table->foreign('course_source_id', 'fk_education_courses_1')->references('id')->on('lookup_course_sources')->onUpdate('CASCADE');
            $table->foreign('level_field_id', 'fk_education_courses_2')->references('id')->on('level_fields')->onUpdate('CASCADE');
            $table->foreign('academic_year_id', 'fk_education_courses_3')->references('id')->on('academic_years')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_courses', function (Blueprint $table) {
            $table->dropForeign('fk_education_courses_1');
            $table->dropForeign('fk_education_courses_2');
            $table->dropForeign('fk_education_courses_3');
        });

        Schema::dropIfExists('education_courses');
    }
}
