<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('title');
            $table->unsignedTinyInteger('multiplier')->default(0);
            $table->string('reference_name');
            $table->string('reference_code')->nullable();
            $table->boolean('is_available')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_courses', function (Blueprint $table) {
            $table->dropForeign('fk_education_courses_1');
            $table->dropForeign('fk_education_courses_2');
            $table->dropForeign('fk_education_courses_3');
        });

        Schema::dropIfExists('education_courses');
    }
}
