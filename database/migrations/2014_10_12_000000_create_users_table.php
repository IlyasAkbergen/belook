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
            $table->string('name');
            //$table->integer('isactive');
            $table->string('email')->unique();
            $table->double('rating',2,1)->default('0.0');
            $table->string('tel')->nullable();
            $table->string('avatar')->nullable();
            $table->string('wallpaper')->nullable();
            $table->string('role');
            $table->tinyInteger('active')->default('0');
            $table->string('token')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
