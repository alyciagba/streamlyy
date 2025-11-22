<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Usuário logado
        $usuarioLogado = $request->session()->get('usuario', 'Convidado');

        // Caminho do arquivo JSON temporário
        $jsonPath = base_path('public/data/filmes.json');

        $filmes = [];
        if (file_exists($jsonPath)) {
            $raw = file_get_contents($jsonPath);
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                $filmes = $decoded;
            }
        }

        return view('pages.index', [
            'usuario' => $usuarioLogado,
            'filmes' => $filmes
        ]);
    }
}
