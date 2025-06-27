<?php


// Ruta raíz: comprobación de conexión DB
// routes/web.php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// login & logout
Route::get ('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Productos protegidos
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
});

// Ruta raíz para tu prueba de conexión (puedes quitarla cuando quieras)
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
