<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnualPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_schedule_annual_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('presentation_id');

            $table->time('start_at');
            $table->time('end_at');
            $table->enum('day_of_week', ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday']);
            $table->unsignedTinyInteger('time_of_day');
            $table->unsignedTinyInteger('part_of_time')->default(1);

            $table->date('valid_from_date')->nullable();
            $table->date('valid_to_date')->nullable();

            $table->text('description')->nullable();
        });

        Schema::table('education_schedule_annual_plans', function (Blueprint $table) {
            $table->foreign('presentation_id', 'fk_education_schedule_annual_plans_1')->references('id')->on('education_course_presentations')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_schedule_annual_plans', function (Blueprint $table) {
            $table->dropForeign('fk_education_schedule_annual_plans_1');
        });

        Schema::dropIfExists('education_schedule_annual_plans');
    }
}
