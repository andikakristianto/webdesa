<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function indexadmin()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        if ($request->has('email')) {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $remember_me = $request->has('remember_token') ? true : false;



            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'role' => 'admin'], $remember_me)) {
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            }

        } elseif ($request->has('nik')) {
            $credentials = $request->validate([
                'nik' => 'required|min:3',
                'password' => 'required',
            ]);

            if (Auth::attempt(['nik' => $credentials['nik'], 'password' => $credentials['password'], 'role' => 'user'])) {
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'login' => 'Login gagal. Pastikan kredensial Anda benar.',
        ]);
    }

    public function logout()
    {
        if (Auth::user()->role === "admin") {
        Auth::logout();
            return redirect("/login/admin");
        }elseif (Auth::user()->role === "user") {
            Auth::logout();
            return redirect("login");
        }
    }

}
