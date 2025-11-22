<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ListaController;

// -----------------------
// Rotas públicas
// -----------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login e cadastro
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/cadastro', [AuthController::class, 'showCadastro'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'registrar'])->name('cadastro.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -----------------------
// Rotas protegidas por login
// -----------------------
Route::middleware('auth')->group(function () {

    // Perfil do usuário
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');

    // Listas personalizadas
    Route::get('/listas', [ListaController::class, 'index'])->name('listas.index');
    Route::post('/listas', [ListaController::class, 'store'])->name('listas.store');
    Route::put('/listas/{lista}', [ListaController::class, 'update'])->name('listas.update');
    Route::delete('/listas/{lista}', [ListaController::class, 'destroy'])->name('listas.destroy');

    // Adicionar/remover filmes em listas
    Route::post('/listas/{lista}/add-filme', [ListaController::class, 'addFilme'])->name('listas.addFilme');
    Route::post('/listas/{lista}/remove-filme', [ListaController::class, 'removeFilme'])->name('listas.removeFilme');
});

// -----------------------
// Filmes
// -----------------------
Route::get('/filmes/{id}', [FilmeController::class, 'detalhes'])->name('filmes.detalhes');
