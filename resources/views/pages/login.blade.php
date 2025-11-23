@include('includes.header')

<main class="p-8">
    <section id="login-section">
        <form id="formLogin" method="POST" action="{{ route('login.submit') }}" class="w-full bg-white p-6 rounded shadow-md max-w-md mx-auto">
        @csrf
        <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>

        {{-- Mensagem de erro --}}
        @if(session('error'))
            <p class="text-red-600 mb-4">{{ session('error') }}</p>
        @endif

        {{-- Email --}}
        <label for="email" class="block mb-1">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required class="form-input w-full mb-3">

        {{-- Senha --}}
        <label for="senha" class="block mb-1">Senha:</label>
        <input type="password" name="senha" id="senha" required class="form-input w-full mb-4">

        {{-- Botão --}}
        <button type="submit" class="btn btn-primary w-full">Entrar</button>
        </form>
    </section>
</main>

@include('includes.footer')
