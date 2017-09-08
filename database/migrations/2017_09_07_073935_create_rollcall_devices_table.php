<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollcallDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rollcall_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();//
            $table->string('national_code');
            $table->smallInteger('Machine_Number')->comment('شماره دستگاه');
            $table->integer('Enroll_Number')->comment('شماره یونیک هر فرد در دستگاه');
            $table->smallInteger('Verify_Mode')->comment('نوع ثبت کارت یا اثر انگشت');
            $table->integer('Year');
            $table->smallInteger('Month');
            $table->smallInteger('Day');
            $table->smallInteger('Hour');
            $table->smallInteger('Minute');
            $table->smallInteger('Second');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rollcall_devices');
    }
}
