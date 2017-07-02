<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_parents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('student_id');
            $table->enum('relative', ['father', 'mother', 'other']);
            $table->string('mobile_1', 20);
            $table->string('mobile_2', 20)->nullable();
        });

        Schema::table('user_parents', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_user_parents_1')->references('id')->on('users')->onUpdate('CASCADE');
            $table->foreign('student_id', 'fk_user_parents_2')->references('id')->on('user_students')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_parents', function (Blueprint $table) {
            $table->dropForeign('fk_user_parents_1');
            $table->dropForeign('fk_user_parents_2');
        });

        Schema::dropIfExists('parents');
    }
}
