<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Filme;

class PerfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Filmes assistidos pelo usuário (relacionamento muitos-para-muitos com pivot)
        $filmesAssistidos = $user->filmes()->withPivot('avaliacao', 'comentario')->get();

        return view('pages.perfil', [
            'nomeUsuario' => $user->nome,
            'fotoUsuario' => $user->foto ?? 'default.jpg',
            'filmesAssistidos' => $filmesAssistidos
        ]);
    }
}
