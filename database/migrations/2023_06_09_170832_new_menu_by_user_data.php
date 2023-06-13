<?php

use App\Http\Entity\Menu;
use App\Http\Entity\MenuByUser;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewMenuByUserData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $menuUser = new MenuByUser([
            'menu_id' => Menu::ADMINISTRACION,
            'user_id' => 1,
            'status' => 1
        ]);
        $menuUser->save();
        $menuUser = new MenuByUser([
            'menu_id' => Menu::ADMIN_USERS,
            'user_id' => 1,
            'status' => 1
        ]);
        $menuUser->save();
        $menuUser = new MenuByUser([
            'menu_id' => Menu::EFC,
            'user_id' => 1,
            'status' => 1
        ]);
        $menuUser->save();
        $menuUser = new MenuByUser([
            'menu_id' => Menu::CURSOS_EFC,
            'user_id' => 1,
            'status' => 1
        ]);
        $menuUser->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
