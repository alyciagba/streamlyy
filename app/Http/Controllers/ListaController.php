<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\Filme;

class ListaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $listas = $user->listas()->with('filmes')->get();

        return view('pages.listas', [
            'nomeUsuario' => $user->nome,
            'listas' => $listas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['nome' => 'required|string|max:255']);

        $user = auth()->user();
        $user->listas()->create(['nome' => $request->nome]);

        return back()->with('success', 'Lista criada!');
    }

    public function update(Request $request, Lista $lista)
    {
        $this->authorize('update', $lista);
        $request->validate(['nome' => 'required|string|max:255']);

        $lista->update(['nome' => $request->nome]);
        return back()->with('success', 'Lista atualizada!');
    }

    public function destroy(Lista $lista)
    {
        $this->authorize('delete', $lista);
        $lista->delete();
        return back()->with('success', 'Lista removida!');
    }

    public function addFilme(Request $request, Lista $lista)
    {
        $this->authorize('update', $lista);
        $filmeId = $request->filme_id;
        $lista->filmes()->syncWithoutDetaching([$filmeId]);
        return back()->with('success', 'Filme adicionado à lista!');
    }

    public function removeFilme(Request $request, Lista $lista)
    {
        $this->authorize('update', $lista);
        $filmeId = $request->filme_id;
        $lista->filmes()->detach($filmeId);
        return back()->with('success', 'Filme removido da lista!');
    }
}
       