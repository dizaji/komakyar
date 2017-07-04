<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookup_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('title');
            $table->integer('level_field_id');
            $table->integer('multiplier')->default(1);
            $table->string('reference_code')->nullable();
            $table->string('reference_name')->nullable();
        });

        Schema::table('lookup_courses', function (Blueprint $table) {
            $table->foreign('level_field_id', 'fk_lookup_courses_1')->references('id')->on('level_fields')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lookup_courses', function (Blueprint $table) {
            $table->dropForeign('fk_lookup_courses_1');
        });

        Schema::dropIfExists('lookup_courses');
    }
}
