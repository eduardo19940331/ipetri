<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at');
            $table->dateTime('updated_at')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->date('birthday')->nullable();
            $table->date('arrivaldate')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('rut')->unique();
            $table->integer('sex');
            $table->string('password');
            $table->integer('status');
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('user');
    }
}
