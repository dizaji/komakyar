<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupPresentedCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_group_presented_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('presentation_id');
            $table->unsignedInteger('group_id');

            $table->text('description');
        });

        Schema::table('education_group_presented_courses', function (Blueprint $table) {
            $table->foreign('presentation_id', 'fk_group_presented_courses_1')->references('id')->on('education_course_presentations')->onUpdate('CASCADE');
            $table->foreign('group_id', 'fk_group_presented_courses_2')->references('id')->on('education_groups')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_group_presented_courses', function (Blueprint $table) {
            $table->dropForeign('fk_group_presented_courses_1');
            $table->dropForeign('fk_group_presented_courses_2');
        });

        Schema::dropIfExists('education_group_presented_courses');
    }
}
