<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRollCallDeviceUserIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_call_device_user_id', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('roll_call_device_id');

            $table->string('device_user_id')->comment('Unique number of each user in each device');
        });

        Schema::table('roll_call_device_user_id', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_roll_call_device_user_id_1')->references('id')->on('users')->onUpdate('CASCADE');
            $table->foreign('roll_call_device_id', 'fk_roll_call_device_user_id_2')->references('id')->on('roll_call_devices')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roll_call_device_user_id', function (Blueprint $table) {
            $table->dropForeign('fk_roll_call_device_user_id_1');
            $table->dropForeign('fk_roll_call_device_user_id_2');
        });

        Schema::dropIfExists('roll_call_device_user_id');
    }
}
