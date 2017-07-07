<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_group_grades', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('daily_program_id');
            $table->unsignedInteger('group_student_id');
            $table->unsignedInteger('grade_type_id');

            $table->time('record_time')->nullable();
            $table->float('grade');
            $table->text('description')->nullable();
        });

        Schema::table('education_group_grades', function (Blueprint $table) {
            $table->foreign('daily_program_id', 'fk_education_group_grades_1')->references('id')->on('education_daily_programs')->onUpdate('CASCADE');
            $table->foreign('group_student_id', 'fk_education_group_grades_2')->references('id')->on('education_group_students')->onUpdate('CASCADE');
            $table->foreign('grade_type_id', 'fk_education_group_grades_3')->references('id')->on('user_teacher_grade_types')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_group_grades', function (Blueprint $table) {
            $table->dropForeign('fk_education_group_grades_1');
            $table->dropForeign('fk_education_group_grades_2');
            $table->dropForeign('fk_education_group_grades_3');
        });

        Schema::dropIfExists('education_group_grades');
    }
}
