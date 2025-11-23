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

        if (!$user) {
            // Guest: no listas available
            return view('pages.listas', [
                'nomeUsuario' => null,
                'listas' => collect()
            ]);
        }

        // Authenticated user: load their listas
        $listas = $user->listas()->with('filmes')->get();
        // Also provide the full filmes list so the user can add films to lists from the listas page
        $todosFilmes = \App\Models\Filme::all();

        return view('pages.listas', [
            'nomeUsuario' => $user->name ?? $user->nome,
            'listas' => $listas,
            'todosFilmes' => $todosFilmes,
        ]);
    }

    /**
     * Add a film to a list by generic params (lista_id + filme_id).
     * This is used by the film details page where the target list is selected via a dropdown.
     */
    public function addFilmeToList(Request $request)
    {
        $request->validate([
            'lista_id' => 'required|integer|exists:listas,id',
            'filme_id' => 'required|integer|exists:filmes,id',
        ]);

        $lista = Lista::findOrFail($request->lista_id);
        $user = auth()->user();
        if ($lista->user_id !== $user->id) {
            abort(403);
        }

        $lista->filmes()->syncWithoutDetaching([$request->filme_id]);

        return back()->with('success', 'Filme adicionado à lista!');
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
        $user = auth()->user();
        if ($lista->user_id !== $user->id) {
            abort(403);
        }
        $request->validate(['nome' => 'required|string|max:255']);

        $lista->update(['nome' => $request->nome]);
        return back()->with('success', 'Lista atualizada!');
    }

    public function destroy(Lista $lista)
    {
        $user = auth()->user();
        if ($lista->user_id !== $user->id) {
            abort(403);
        }
        $lista->delete();
        return back()->with('success', 'Lista removida!');
    }

    public function addFilme(Request $request, Lista $lista)
    {
        $user = auth()->user();
        if ($lista->user_id !== $user->id) {
            abort(403);
        }
        $filmeId = $request->filme_id;
        $lista->filmes()->syncWithoutDetaching([$filmeId]);
        return back()->with('success', 'Filme adicionado à lista!');
    }

    public function removeFilme(Request $request, Lista $lista)
    {
        $user = auth()->user();
        if ($lista->user_id !== $user->id) {
            abort(403);
        }
        $filmeId = $request->filme_id;
        $lista->filmes()->detach($filmeId);
        return back()->with('success', 'Filme removido da lista!');
    }
}
       