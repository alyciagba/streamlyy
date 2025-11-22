<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;

class FilmeController extends Controller
{
    public function detalhes($id)
    {
        $filme = Filme::with('usuarios')->findOrFail($id); 

        return view('pages.filme', [
            'filme' => $filme
        ]);
    }
}
