@include('includes.header')

<main class="p-8 flex justify-center">
    <form method="POST" action="{{ route('cadastro.submit') }}" class="bg-white p-6 rounded shadow-md w-full max-w-md">
        @csrf

        <h2 class="text-2xl font-bold mb-4 text-center">Criar Conta</h2>

        @if(session('error'))
            <p class="text-red-600 mb-4">{{ session('error') }}</p>
        @endif

        @if(session('success'))
            <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif

        {{-- Nome --}}
        <label class="block mb-1">Nome completo:</label>
        <input type="text" name="nome" required class="w-full mb-3 p-2 border rounded">

        {{-- Email --}}
        <label class="block mb-1">E-mail:</label>
        <input type="email" name="email" required class="w-full mb-3 p-2 border rounded">

        {{-- Data de nascimento --}}
        <label class="block mb-1">Data de nascimento:</label>
        <input type="date" name="nascimento" required class="w-full mb-3 p-2 border rounded">

        {{-- Senha --}}
        <label class="block mb-1">Senha:</label>
        <input type="password" name="senha" required minlength="6" class="w-full mb-3 p-2 border rounded">

        {{-- Confirmação --}}
        <label class="block mb-1">Confirmar senha:</label>
        <input type="password" name="senha_confirmation" required minlength="6" class="w-full mb-4 p-2 border rounded">

        <button class="w-full bg-blue-600 text-white py-2 rounded">Cadastrar</button>
    </form>
</main>

@include('includes.footer')
