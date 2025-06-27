<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /* Formulario de login (solo invitados) */
    public function showLogin()
    {
        return view('login');   // resources/views/login.blade.php
    }

    /* Procesa login */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        // Throttle: 5 intentos/1 minuto (opcional)
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Credenciales inválidas.',
            ]);
        }

        $request->session()->regenerate();

        /* Redirección por rol */
        $role = Auth::user()->role;
        return match ($role) {
            'administrador'  => redirect()->intended('/dashboard'),
            'cajero' => redirect()->intended('/pos'),
            default  => redirect()->intended(route('cliente.home')),
        };
    }

    /* Cierra sesión */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
