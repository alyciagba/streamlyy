<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Mostra a página de login
    public function showLogin()
    {
        return view('pages.login');
    }

    // Processa o login
    public function login(Request $request)
    {
        $usuario = $request->input('usuario');
        $senha = $request->input('senha');

        $user = User::where('name', $usuario)->first();

        if ($user && Hash::check($senha, $user->password)) {
            $request->session()->put('usuario', $user->name);
            return redirect('/');
        }

        return back()->with('error', 'Usuário ou senha incorretos!');
    }

    // Mostra a página de cadastro
    public function showCadastro()
    {
        return view('pages.cadastro');
    }

    // Processa o cadastro
    public function registrar(Request $request)
    {
        if ($request->senha !== $request->confirmar) {
            return back()->with('error', 'As senhas não coincidem!');
        }

        User::create([
            'name' => $request->nome,
            'email' => $request->email,
            'nascimento' => $request->nascimento,
            'password' => Hash::make($request->senha)
        ]);

        return back()->with('success', 'Conta criada com sucesso!');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('usuario');
        return redirect('/login');
    }
}
