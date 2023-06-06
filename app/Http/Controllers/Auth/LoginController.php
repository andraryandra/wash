<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if (Auth::user()->role === 'admin' || Auth::user()->role === '1') {
            return redirect()->route('admin.home');
        } elseif (Auth::user()->role === 'user' || Auth::user()->role === '0') {
            return redirect()->route('user.home');
        } else {
            return redirect()->route('login');
        }
    }
}
