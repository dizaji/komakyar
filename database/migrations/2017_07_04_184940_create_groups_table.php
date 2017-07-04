<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('level_field_id');
            $table->unsignedInteger('academic_year_id');

            $table->string('title');
        });

        Schema::table('education_groups', function (Blueprint $table) {
            $table->foreign('level_field_id', 'fk_education_groups_1')->references('id')->on('level_fields')->onUpdate('CASCADE');
            $table->foreign('academic_year_id', 'fk_education_groups_2')->references('id')->on('academic_years')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_groups', function (Blueprint $table) {
            $table->dropForeign('fk_education_groups_1');
            $table->dropForeign('fk_education_groups_2');
        });

        Schema::dropIfExists('education_groups');
    }
}
