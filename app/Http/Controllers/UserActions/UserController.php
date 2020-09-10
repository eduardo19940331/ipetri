<?php

namespace App\Http\Controllers\UserActions;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Database\Entity\User\User;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function index()
    {
        return view('admin.user.index', ['name' => 'ok']);
    }

    public function getUsersData()
    {
        $users = \App\Http\Entity\User::where('status', '=', 1)->whereNull('deleted_at')->get();

        return json_encode(['data' => $users]);
    }

    public function getUserCreated()
    {
        return view('admin.user.new');
    }
}
