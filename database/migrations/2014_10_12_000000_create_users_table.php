<?php

use App\Http\Entity\User;
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
        Schema::create(User::table(), function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('rut')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('password');
            $table->integer('gender');
            $table->date('birthday')->nullable();
            $table->date('arrivaldate')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->integer('status');
            $table->softDeletes();
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
