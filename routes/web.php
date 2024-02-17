<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
/*
Route authenticate
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

  /*
  Route vendas
  */
  Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
  Route::get('/sales/create', [SalesController::class, 'create'])->name('sales.create');
  Route::post('/sales/create', [SalesController::class, 'store']);

  /*
  Route produtos
  */
  Route::get('/products', [ProductController::class, 'index'])->name('products.index');
  Route::post('/products', [ProductController::class, 'store'])->name('products.store');
  Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

  /*
  Route clientes
  */
  Route::get('/clients', [ClientsController::class, 'index'])->name('clients.index');
  Route::get('/clients/create', [ClientsController::class, 'create'])->name('clients.create');
  Route::post('/clients/create', [ClientsController::class, 'store'])->name('clients.store');

});

Route::get('/', function () {
    return view('welcome');
});
