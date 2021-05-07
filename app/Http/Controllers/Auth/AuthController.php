<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('backend.auth.register');
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
        $validateData['password'] = bcrypt($validateData['password']);
        $user = User::create($validateData);
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }
    
    public function login(Request $request)
    {
        $cridentials = $request->only('email','password');
        $remember = $request->input('remember');

        if (Auth::attempt($cridentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
