<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('level_id');
            $table->unsignedInteger('field_id');
            $table->unsignedInteger('parent_id')->nullable();
        });

        Schema::table('level_fields', function (Blueprint $table) {
            $table->foreign('level_id', 'fk_level_fields_1')->references('id')->on('lookup_levels')->onUpdate('CASCADE');
            $table->foreign('field_id', 'fk_level_fields_2')->references('id')->on('lookup_fields')->onUpdate('CASCADE');
            $table->foreign('parent_id', 'fk_level_fields_3')->references('id')->on('level_fields')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('level_fields', function (Blueprint $table) {
            $table->dropForeign('fk_level_fields_1');
            $table->dropForeign('fk_level_fields_2');
            $table->dropForeign('fk_level_fields_3');
        });

        Schema::dropIfExists('level_fields');
    }
}
