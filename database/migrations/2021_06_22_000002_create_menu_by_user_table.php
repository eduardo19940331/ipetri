<?php

use App\Http\Entity\Menu;
use App\Http\Entity\MenuByUser;
use App\Http\Entity\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuByUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(MenuByUser::table(), function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('menu_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on(User::table());
            $table->foreign('menu_id')->references('id')->on(Menu::table());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_by_user');
    }
}
