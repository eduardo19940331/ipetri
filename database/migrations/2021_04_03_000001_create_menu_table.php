<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id');
            $table->integer('menu_id')->unsigned();
            $table->string('name_menu');
            $table->integer('status');
            $table->dateTime('deleted_at');
            $table->timestamps();
        });

        // Schema::table('menu', function (Blueprint $table) {
        //     $table->foreign('menu_id')->references('id')->on('menu_by_user');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
