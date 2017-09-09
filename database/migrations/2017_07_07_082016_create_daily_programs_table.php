<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_daily_programs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('presentation_id');
            $table->unsignedInteger('staff_id')->nullable();
            $table->unsignedInteger('group_id');

            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->unsignedTinyInteger('time_of_day');
            $table->unsignedTinyInteger('part_of_time')->default(1);

            $table->text('description')->nullable();
        });

        Schema::table('education_daily_programs', function (Blueprint $table) {
            $table->foreign('presentation_id', 'fk_education_daily_programs_1')->references('id')->on('education_course_presentations')->onUpdate('CASCADE');
            $table->foreign('staff_id', 'fk_education_daily_programs_2')->references('id')->on('user_staffs')->onUpdate('CASCADE');
            $table->foreign('group_id', 'fk_education_daily_programs_3')->references('id')->on('education_groups')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_daily_programs', function (Blueprint $table) {
            $table->dropForeign('fk_education_daily_programs_1');
            $table->dropForeign('fk_education_daily_programs_2');
            $table->dropForeign('fk_education_daily_programs_3');
        });

        Schema::dropIfExists('education_daily_programs');
    }
}
