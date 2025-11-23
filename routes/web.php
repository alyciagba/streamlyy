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

// Páginas estáticas
Route::view('/sobre', 'pages.sobre')->name('sobre');
Route::view('/contato', 'pages.contato')->name('contato');

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
// Perfil do usuário (protected)
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');

    // List actions that require auth (create/update/delete, add/remove filmes)
    Route::post('/listas', [ListaController::class, 'store'])->name('listas.store');
    Route::put('/listas/{lista}', [ListaController::class, 'update'])->name('listas.update');
    Route::delete('/listas/{lista}', [ListaController::class, 'destroy'])->name('listas.destroy');

    // Adicionar/remover filmes em listas
    Route::post('/listas/{lista}/add-filme', [ListaController::class, 'addFilme'])->name('listas.addFilme');
    Route::post('/listas/{lista}/remove-filme', [ListaController::class, 'removeFilme'])->name('listas.removeFilme');
});

// Make the listas index public so guests can see a helpful message and be prompted to login/register
Route::get('/listas', [ListaController::class, 'index'])->name('listas.index');

// Generic add-filme route used by the film details page (select a list and add this film)
Route::middleware('auth')->post('/listas/add-filme', [ListaController::class, 'addFilmeToList'])->name('listas.addFilme.generic');

// -----------------------
// Filmes
// -----------------------
Route::get('/filmes/{id}', [FilmeController::class, 'detalhes'])->name('filmes.detalhes');

// Actions that require authentication: add as watched and rankear
Route::middleware('auth')->group(function () {
    Route::post('/filmes/{id}/adicionar', [FilmeController::class, 'adicionar'])->name('filmes.adicionar');
    Route::post('/filmes/{id}/rankear', [FilmeController::class, 'rankear'])->name('filmes.rankear');
});
