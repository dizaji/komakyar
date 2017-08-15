<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->rememberToken();
            $table->timestamps();
            $table->string('first_name');
            $table->string('surname');
            $table->string('email')->nullable();
            $table->string('national_code')->nullable();
            $table->string('password');
            $table->boolean('is_student')->default(false);
            $table->boolean('is_teacher')->default(false);
            $table->boolean('is_staff')->default(false);
            $table->boolean('is_parent')->default(false);
            $table->string('profile_picture')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
