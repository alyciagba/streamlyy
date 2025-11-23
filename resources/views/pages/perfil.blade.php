@include('includes.header')

<main class="p-8">
    <section id="profile-section" class="max-w-lg mx-auto bg-white p-6 rounded shadow-md">
        <div class="flex items-center gap-4 mb-4">
        <img src="{{ $fotoUsuario ? asset('images/users/' . $fotoUsuario) : asset('images/users/default.jpg') }}" 
                alt="Foto do Usuário" class="avatar" />
            <span id="profile-username" class="text-xl font-semibold">{{ $nomeUsuario ?? 'Convidado' }}</span>
        </div>

        @if($nomeUsuario)
            <p>Bem-vindo(a) ao seu perfil, {{ $nomeUsuario }}!</p>

            {{-- Seção de filmes assistidos --}}
            <div id="filmes-assistidos" class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Filmes Assistidos</h3>

                @if($filmesAssistidos->isEmpty())
                    <p>Você ainda não assistiu a nenhum filme.</p>
                @else
                    <ul class="list-disc ml-4">
                        @foreach($filmesAssistidos as $filme)
                            <li class="mb-2">
                                <strong>{{ $filme->titulo }}</strong> — Nota: {{ $filme->pivot->avaliacao ?? 'N/A' }} ★
                                <br>
                                Comentário: {{ $filme->pivot->comentario ?? '-' }}
                                <br>
                                <button onclick="window.location.href='{{ route('filmes.detalhes', $filme->id) }}'" 
                                        class="mt-1 bg-blue-600 text-white px-2 py-1 rounded text-sm">
                                    Ver detalhes
                                </button>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Seção de listas --}}
            <div id="listas-section" class="mt-6">
                <h3 class="text-lg font-semibold mb-2">Suas Listas</h3>

                <div class="flex gap-2 mb-4">
                    <form method="POST" action="{{ route('listas.store') }}" class="flex gap-2 w-full">
                        @csrf
                        <input name="nome" type="text" placeholder="Nome da nova lista" 
                               class="form-input p-2 border rounded flex-grow" required />
                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Criar lista</button>
                    </form>
                </div>

                <div id="listas-container">
                    @foreach($listas as $lista)
                        <div class="mb-2 p-2 border rounded">
                            <strong>{{ $lista->nome }}</strong>
                            <ul class="ml-4">
                                @foreach($lista->filmes as $filme)
                                    <li>{{ $filme->titulo }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

        @else
            <p>Você não está logado. <a href="{{ url('/login') }}">Entrar</a> para ver seu perfil e seus filmes.</p>
        @endif
    </section>
</main>

@include('includes.footer')
