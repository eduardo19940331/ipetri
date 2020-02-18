<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Cambio de campo para el login
     *
     * @return string username
     */
    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $credentials = [
            "username" => $request->get('username'),
            "password" => $request->get('password'),
            "status" => 1
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin/');
        } else {
            return redirect()->intended('/login');
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
