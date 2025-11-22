@include('includes.header')

<main class="p-8">
    <section class="max-w-3xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4">Listas de Filmes</h2>
        <div id="listas-page">
            <p>Aqui você pode ver suas listas de filmes.</p>

            @if($nomeUsuario)
                <div class="flex gap-2 mt-1">
                    <select id="adicionar-filme-lista" class="form-input p-2 border rounded"></select>
                    <input id="adicionar-filme-nome" type="text" placeholder="Título do filme" 
                           class="form-input flex-grow p-2 border rounded" />
                    <button id="adicionar-filme-btn" class="bg-blue-600 text-white px-3 py-1 rounded">
                        Adicionar
                    </button>
                </div>
            @else
                <p>Você precisa estar logado para gerenciar listas. 
                   <a href="{{ url('/login') }}">Entrar</a>
                </p>
            @endif
        </div>
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
