<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Login & Logout
Route::get ('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// CRUD Productos protegido
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('users',    UserController::class);
});

// Ruta raíz para comprobación de conexión DB
Route::get('/', function () {
    try {
        $users    = DB::table('users')->get();
        $products = DB::table('products')->get();
        $sales    = DB::table('sales')->get();
        $details  = DB::table('sale_details')->get();
        return view('check-db', compact('users','products','sales','details'));
    } catch (\Exception $e) {
        return "❌ Error de conexión a la base de datos: ".$e->getMessage();
    }
});
