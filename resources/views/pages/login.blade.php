@include('includes.header')

<main class="p-8 flex justify-center">
    <form id="formLogin" method="POST" action="{{ route('login.submit') }}" class="bg-white p-6 rounded shadow-md w-full max-w-md">
        @csrf
        <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

        {{-- Mensagem de erro --}}
        @if(session('error'))
            <p class="text-red-600 mb-4">{{ session('error') }}</p>
        @endif

        {{-- Usuário --}}
        <label for="usuario" class="block mb-1">Usuário:</label>
        <input type="text" name="usuario" id="usuario" value="{{ old('usuario') }}" required class="w-full mb-3 p-2 border rounded">

        {{-- Senha --}}
        <label for="senha" class="block mb-1">Senha:</label>
        <input type="password" name="senha" id="senha" required class="w-full mb-4 p-2 border rounded">

        {{-- Botão --}}
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Entrar</button>
    </form>
</main>

@include('includes.footer')
