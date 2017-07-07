<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_group_rollcalls', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('daily_program_id');
            $table->unsignedInteger('group_student_id');

            $table->time('arrive_time')->nullable();
            $table->enum('type', ['attend', 'unjustified_absence', 'justified_absence', 'unjustified_delay', 'justified_delay', 'NA'])->default('NA');
            $table->text('description')->nullable();
        });

        Schema::table('education_group_rollcalls', function (Blueprint $table) {
            $table->foreign('daily_program_id', 'fk_education_group_rollcalls_1')->references('id')->on('education_daily_programs')->onUpdate('CASCADE');
            $table->foreign('group_student_id', 'fk_education_group_rollcalls_2')->references('id')->on('education_group_students')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_group_rollcalls', function (Blueprint $table) {
            $table->dropForeign('fk_education_group_rollcalls_1');
            $table->dropForeign('fk_education_group_rollcalls_2');
        });

        Schema::dropIfExists('education_group_rollcalls');
    }
}
