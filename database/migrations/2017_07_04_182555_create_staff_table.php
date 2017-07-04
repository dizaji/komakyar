<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_staffs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->enum('degree', ['below diploma', 'diploma', 'BsC', 'MsC', 'PhD', 'Other'])->nullable();
            $table->string('field_of_study')->nullable();
            $table->string('direct_no')->nullable();
            $table->string('extension')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_visible')->default(true);
        });

        Schema::table('user_staffs', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_user_staffs_1')->references('id')->on('users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_staffs', function (Blueprint $table) {
            $table->dropForeign('fk_user_staffs_1');
        });

        Schema::dropIfExists('user_staffs');
    }
}
