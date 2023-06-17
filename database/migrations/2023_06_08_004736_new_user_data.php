<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Entity\User;

class NewUserData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    
        $user = new User();
        $user->rut ='186477138';
        $user->first_name ='erick';
        $user->last_name ='martinez';
        $user->username ='em';
        $user->password ='123';
        $user->gender =1;
        $user->email ='a@gmail.com';
        $user->phone ='53940007';
        $user->status =1;
        $user->save ();



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
