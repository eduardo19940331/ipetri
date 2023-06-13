<?php

use App\Http\Entity\Menu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewMenuData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $menu = new Menu([
            'id' => Menu::ADMINISTRACION,
            'name_menu' => "Administración",
            'icon' => "fa fa-cog"
        ]);
        $menu->save();
        $menu = new Menu([
            'id' => Menu::ADMIN_USERS,
            'name_menu' => "Usuarios",
            'url' => "adminUserData",
            'icon' => "fa fa-users",
            'parent_id' => Menu::ADMINISTRACION
        ]);
        $menu->save();
        $menu = new Menu([
            'id' => Menu::EFC,
            'name_menu' => "EFC",
            'icon' => "fa fa-book"
        ]);
        $menu->save();
        $menu = new Menu([
            'id' => Menu::CURSOS_EFC,
            'name_menu' => "Cursos",
            'url' => "christianTrainingSchool",
            'icon' => "fa fa-address-book",
            'parent_id' => Menu::EFC
        ]);
        $menu->save();
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
