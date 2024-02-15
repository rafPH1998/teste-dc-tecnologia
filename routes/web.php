<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


/*
Route authenticate
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');

Route::get('/', function () {
    return view('welcome');
});
