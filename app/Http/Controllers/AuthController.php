<?php

// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Muestra formulario
    public function showLogin()
    {
        return view('login');
    }

    // Procesa login
    public function login(Request $r)
    {
        $cred = $r->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($cred)) {
            $r->session()->regenerate();
            return redirect()->intended('products');
        }
        return back()->withErrors(['email'=>'Credenciales inválidas']);
    }

    // Cierra sesión
    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect('/login');
    }
}
