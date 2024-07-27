<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect('/transaction');
        }
        
        return redirect('login')->withErrors(['username' => 'Username or password is incorrect']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
