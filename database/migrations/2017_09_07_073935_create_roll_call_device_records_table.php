<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRollCallDeviceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_call_device_records', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('device_id');

            $table->time('roll_called_at')->nullable();
            $table->enum('verify_type', ['finger_print', 'card']);
            $table->enum('type', ['arrive', 'depart'])->nullable();
        });

        Schema::table('roll_call_device_records', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_roll_call_device_records_1')->references('id')->on('users')->onUpdate('CASCADE');
            $table->foreign('roll_call_device_id', 'fk_roll_call_device_records_2')->references('id')->on('roll_call_devices')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('roll_call_device_records', function (Blueprint $table) {
            $table->dropForeign('fk_roll_call_device_records_1');
            $table->dropForeign('fk_roll_call_device_records_2');
        });
        Schema::dropIfExists('roll_call_device_records');
    }
}
