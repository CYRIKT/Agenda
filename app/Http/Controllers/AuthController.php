<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function showLogin() 
    {
        return view('auth.login');    
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && password_verify($request->password, $user->password)){
            Auth::login($user);
            return redirect()->route('agenda')->with('succes', 'Login successful');
        }
        return redirect()->back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('succes', 'Logout successful');
    }
}
