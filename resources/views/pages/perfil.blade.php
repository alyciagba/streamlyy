@include('includes.header')

<main class="p-8">
    <section id="profile-section" class="max-w-lg mx-auto bg-white p-6 rounded shadow-md">
        <div class="flex items-center gap-4 mb-4">
            <img src="{{ $fotoUsuario ?? asset('images/default.jpg') }}" 
                 alt="Foto do Usuário" class="avatar" />
            <span id="profile-username" class="text-xl font-semibold">{{ $nomeUsuario ?? 'Convidado' }}</span>
        </div>

        @if($nomeUsuario)
            <p>Bem-vindo(a) ao seu perfil, {{ $nomeUsuario }}!</p>

            <div id="profile-info" class="mt-4">
                {{-- Aqui você pode adicionar informações adicionais do usuário --}}
            </div>

            <div id="listas-section" class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Suas Listas</h3>

                <div class="flex gap-2 mb-4">
                    <input id="nova-lista-nome" type="text" placeholder="Nome da nova lista" 
                           class="form-input p-2 border rounded w-full" />
                    <button id="criar-lista-btn" class="bg-blue-600 text-white px-3 py-1 rounded">
                        Criar lista
                    </button>
                </div>

                <div id="listas-container">
                    {{-- Aqui o JS vai popular as listas do usuário --}}
                </div>
            </div>

        @else
            <p>Você não está logado. <a href="{{ url('/login') }}">Entrar</a> para ver seu perfil e seus filmes.</p>
        @endif
    </section>

    @if($nomeUsuario)
        <script>
            window.currentUser = @json($nomeUsuario);

            try {
                if (!localStorage.getItem('usuario')) {
                    localStorage.setItem('usuario', @json($nomeUsuario));
                }
            } catch(e) {}
        </script>
    @endif
</main>

@include('includes.footer')
