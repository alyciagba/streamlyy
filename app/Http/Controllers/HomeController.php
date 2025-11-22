<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;

class HomeController extends Controller
{
    public function index()
    {
        $filmes = Filme::all();
        $usuario = session('usuario', 'Convidado');

        return view('index', compact('filmes', 'usuario'));
    }
}
