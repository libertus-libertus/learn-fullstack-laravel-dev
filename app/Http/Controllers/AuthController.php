<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /** 
     * Masuk ke halaman login 
    */ 
    public function login()
    {
        return view("auth.login");
    }

    /** 
     * Autentikasi user login
    */ 
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ], [
            "email.required" => "Email tidak boleh kosong",
            "password.required" => "Kata sandi tidak boleh kosong",
        ]);

        # lakukan pengecekan / validasi inputan email & password
        if (Auth::attempt($credentials)) {
            # jika berhasil
            $request->session()->regenerate();

            # maka akan diarahkan ke halaman dashboard
            Session::flash("Anda berhasil login!");
            return redirect()->intended("blog");
        }

        # jika tidak berhasil
        return back()->withErrors([
            "email" => "The provided credentials do not match our records.",
        ])->onlyInput("email");
    }

    /** 
     * Proses logout
    */ 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }
}
