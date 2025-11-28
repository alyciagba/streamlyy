<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RankFilmeRequest;

class FilmeController extends Controller
{
    public function detalhes($id)
    {
        $filme = Filme::with('usuarios')->findOrFail($id);

        $user = auth()->user();
        $userListas = collect();
        if ($user) {
            $userListas = $user->listas()->get();
        }

        return view('pages.filme', [
            'filme' => $filme,
            'userListas' => $userListas,
        ]);
    }

    public function adicionar($id)
    {
        $user = Auth::user();
        $filme = Filme::findOrFail($id);

        // attach to pivot without rating/comment
        $user->filmes()->syncWithoutDetaching([$filme->id]);

        return back()->with('success', 'Filme adicionado como assistido.');
    }

    public function rankear(RankFilmeRequest $request, $id)
    {
        $user = Auth::user();
        $filme = Filme::findOrFail($id);

        // update or attach pivot with rating and comment
        $user->filmes()->syncWithoutDetaching([$filme->id]);
        $user->filmes()->updateExistingPivot($filme->id, [
            'avaliacao' => $request->avaliacao,
            'comentario' => $request->comentario
        ]);

        return back()->with('success', 'Obrigado pela avaliação!');
    }
}
