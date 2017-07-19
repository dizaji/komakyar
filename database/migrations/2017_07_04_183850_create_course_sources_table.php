<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookup_course_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('title');
            $table->unsignedInteger('level_field_id');
            $table->string('reference_code')->nullable();
            $table->string('reference_name')->nullable();
        });

        Schema::table('lookup_course_sources', function (Blueprint $table) {
            $table->foreign('level_field_id', 'fk_lookup_course_sources_1')->references('id')->on('level_fields')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lookup_course_sources', function (Blueprint $table) {
            $table->dropForeign('fk_lookup_course_sources_1');
        });

        Schema::dropIfExists('lookup_course_sources');
    }
}
