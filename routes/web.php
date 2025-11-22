<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
use App\Http\Controllers\AuthController;

Route::get('/cadastro', [AuthController::class, 'showCadastro'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'registrar'])->name('cadastro.submit');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');