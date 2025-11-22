<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilmeController extends Controller
{
    public function detalhes($id)
    {
        // Caminho do JSON temporário
        $jsonPath = base_path('public/data/filmes.json');

        $filme = null;

        if (file_exists($jsonPath)) {
            $raw = file_get_contents($jsonPath);
            $decoded = json_decode($raw, true);

            if (is_array($decoded)) {
                foreach ($decoded as $f) {
                    if ($f['id'] == $id) {
                        $filme = $f;
                        break;
                    }
                }
            }
        }

        if (!$filme) {
            abort(404, 'Filme não encontrado');
        }

        return view('pages.filme', [
            'filme' => $filme
        ]);
    }
}
