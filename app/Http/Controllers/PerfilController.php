<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PerfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $filmesAssistidos = $user->filmes()->withPivot('avaliacao', 'comentario')->get();
        $listas = $user->listas()->with('filmes')->get();

        return view('pages.perfil', [
            // use the standard 'name' attribute (was migrated from 'nome')
            'nomeUsuario' => $user->name,
            'fotoUsuario' => $user->foto ?? 'default.jpg',
            'filmesAssistidos' => $filmesAssistidos,
            'listas' => $listas
        ]);
    }
}
