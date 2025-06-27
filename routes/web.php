<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductController;

// Ruta raíz: comprobación de conexión DB
Route::get('/', function () {
    try {
        $users    = DB::table('users')->get();
        $products = DB::table('products')->get();
        $sales    = DB::table('sales')->get();
        $details  = DB::table('sale_details')->get();
        return view('check-db', compact('users', 'products', 'sales', 'details'));
    } catch (\Exception $e) {
        return "❌ Error de conexión a la base de datos: " . $e->getMessage();
    }
});

// CRUD de productos sin protección (hasta que implementes el login)
Route::resource('products', ProductController::class);
