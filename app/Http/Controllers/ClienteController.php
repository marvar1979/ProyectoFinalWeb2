<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Muestra la página de inicio del cliente (catálogo de productos).
     */
    public function home()
    {
        return view('cliente.home');
    }

    /**
     * Muestra la página "Sobre Nosotros".
     */
    public function about()
    {
        return view('cliente.about');
    }

    /**
     * Muestra la página del carrito de compras.
     */
    public function cart()
    {
        return view('cliente.cart');
    }

    /**
     * Muestra el formulario de login para el cliente.
     */
    public function showLogin()
    {
        return view('cliente.login');
    }
}