<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherGradeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_teacher_grade_types', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('course_id');

            $table->string('title');
            $table->integer('maximum_mark')->default(20);
            $table->integer('minimum_mark')->default(0);
            $table->float('step')->default(1);
            $table->boolean('is_visible')->default(true);
        });

        Schema::table('user_teacher_grade_types', function (Blueprint $table) {
            $table->foreign('teacher_id', 'fk_user_teacher_grade_types_1')->references('id')->on('user_teachers')->onUpdate('CASCADE');
            $table->foreign('course_id', 'fk_user_teacher_grade_types_2')->references('id')->on('education_courses')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_teacher_grade_types', function (Blueprint $table) {
            $table->dropForeign('fk_user_teacher_grade_types_1');
            $table->dropForeign('fk_user_teacher_grade_types_2');
        });

        Schema::dropIfExists('user_teacher_grade_types');
    }
}
