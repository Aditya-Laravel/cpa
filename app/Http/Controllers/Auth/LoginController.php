<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\UsersActivity;

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
    protected $redirectTo ;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo=env("PREFIX").'/home';
        $this->middleware('guest')->except('logout');
    }
    public function authenticated(Request $request, $user)
    {
        UsersActivity::create([
            'user_id'=>1,
            'agent'=>\Auth::user()->name,
            'created_at' => now(),
            'ip' => $request->getClientIp()
        ]);
    }
}
