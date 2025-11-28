<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $filmes = Filme::all();
        $usuario = Auth::check() ? Auth::user()->name : 'Convidado';

        return view('index', compact('filmes', 'usuario'));
    }
}
