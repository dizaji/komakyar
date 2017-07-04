<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_group_students', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('group_id');
            $table->unsignedInteger('student_id');
        });

        Schema::table('education_group_students', function (Blueprint $table) {
            $table->foreign('group_id', 'fk_education_group_students_1')->references('id')->on('education_groups')->onUpdate('CASCADE');
            $table->foreign('student_id', 'fk_education_group_students_2')->references('id')->on('user_students')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_group_students', function (Blueprint $table) {
            $table->dropForeign('fk_education_group_students_1')->references('id')->on('education_groups')->onUpdate('CASCADE');
            $table->dropForeign('fk_education_group_students_2')->references('id')->on('user_students')->onUpdate('CASCADE');
        });

        Schema::dropIfExists('education_group_students');
    }
}
