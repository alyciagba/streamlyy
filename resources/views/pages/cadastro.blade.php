@include('includes.header')

<main class="p-8">
    <section id="login-section">
        <form method="POST" action="{{ route('cadastro.submit') }}" class="w-full bg-white p-6 rounded shadow-md max-w-md mx-auto">
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
        <input type="text" name="nome" required class="form-input w-full mb-3">

        {{-- Email --}}
        <label class="block mb-1">E-mail:</label>
        <input type="email" name="email" required class="form-input w-full mb-3">

        {{-- Data de nascimento --}}
        <label class="block mb-1">Data de nascimento:</label>
        <input type="date" name="nascimento" required class="form-input w-full mb-3">

        {{-- Senha --}}
        <label class="block mb-1">Senha:</label>
        <input type="password" name="senha" required minlength="6" class="form-input w-full mb-3">

        {{-- Confirmação --}}
        <label class="block mb-1">Confirmar senha:</label>
        <input type="password" name="senha_confirmation" required minlength="6" class="form-input w-full mb-4">

        <button class="btn btn-primary w-full">Cadastrar</button>
        </form>
    </section>
</main>

@include('includes.footer')
