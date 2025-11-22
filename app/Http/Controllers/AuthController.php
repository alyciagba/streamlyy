<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
        $credentials = [
            'name' => $request->input('usuario'),
            'password' => $request->input('senha')
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
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
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nascimento' => 'required|date',
            'senha' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'data_nascimento' => $request->nascimento,
            'senha' => Hash::make($request->senha)
        ]);

        Auth::login($user);
        return redirect('/')->with('success', 'Conta criada e logada com sucesso!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
