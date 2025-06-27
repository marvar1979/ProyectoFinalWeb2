<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController; // Asegúrate de importar el nuevo controlador
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;

use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\DB;



Route::prefix('/')->name('cliente.')->group(function () {

    /* Catálogo */
    Route::get('/',                [ShopController::class, 'index'])
          ->name('home');
    Route::get('/sobre-nosotros', [ClienteController::class, 'about'])->name('about');
    
});


Route::get ('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    /* productos, sales, dashboard y usuarios solo para el rol administrador*/

   

Route::prefix('/')->name('cliente.')->group(function () {

     /* Carrito solo para el rol cliente*/
    Route::get('/cart',            [CartController::class, 'show'])
          ->name('cart');
    Route::post('/cart/add',       [CartController::class, 'add'])
          ->name('cart.add');
    Route::post('/cart/update',    [CartController::class, 'update'])
          ->name('cart.update');
    Route::post('/cart/checkout',  [CartController::class, 'checkout'])
          ->name('cart.checkout');
});

    Route::resource('products', ProductController::class);
    Route::resource('users',    UserController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/sales',         [SaleController::class, 'index'])->name('sales.index');
    Route::get('/salesC',         [SaleController::class, 'indexC'])->name('sales.indexC');

    Route::get('/sales/{sale}',  [SaleController::class, 'show'])->name('sales.show');


    /* Punto de venta para cajero  solo para el rol cajero*/
    Route::get('/pos',  [SaleController::class, 'create'])
          ->name('sales.create');      // página para vender libros
    Route::post('/pos', [SaleController::class, 'store'])
          ->name('sales.store');       // guarda la venta

});

