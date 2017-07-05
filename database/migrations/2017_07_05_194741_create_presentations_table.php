<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_course_presentations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('course_id');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('group_id');

            $table->text('description')->nullable();
        });

        Schema::table('education_course_presentations', function (Blueprint $table) {
            $table->foreign('course_id', 'fk_education_course_presentations_1')->references('id')->on('education_courses')->onUpdate('CASCADE');
            $table->foreign('teacher_id', 'fk_education_course_presentations_2')->references('id')->on('user_teachers')->onUpdate('CASCADE');
            $table->foreign('group_id', 'fk_education_course_presentations_3')->references('id')->on('education_groups')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_course_presentations', function (Blueprint $table) {
            $table->dropForeign('fk_education_course_presentations_1');
            $table->dropForeign('fk_education_course_presentations_2');
            $table->dropForeign('fk_education_course_presentations_3');
        });

        Schema::dropIfExists('education_course_presentations');
    }
}
