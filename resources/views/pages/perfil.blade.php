@include('includes.header')

<main class="p-8">
    <section id="profile-section" class="max-w-lg mx-auto bg-white p-6 rounded shadow-md">
        @php
            // Always show perfil.png on the perfil page when a user is logged in
            if (Auth::check()) {
                $avatarPath = url('images/users/perfil.png');
            } else {
                // For guests, use provided $fotoUsuario or default perfil.png as last resort
                $avatar = $fotoUsuario ?? null;
                $avatarPath = url('images/users/' . ($avatar ?? 'perfil.png'));
            }
        @endphp
        <div class="text-center mb-4">
            <img id="user-photo" src="{{ $avatarPath }}" alt="Foto do Usuário" class="avatar mx-auto mb-3" />
            <div id="profile-username" class="text-xl font-semibold">{{ $nomeUsuario ?? (Auth::check() ? Auth::user()->name : 'Convidado') }}</div>
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
                        <div class="mb-2 p-2 border rounded flex justify-between items-center">
                            <div>
                                <strong>{{ $lista->nome }}</strong>
                                <div class="text-sm text-gray-600">{{ $lista->filmes->count() }} filmes</div>
                            </div>
                            <div>
                                <a href="{{ url('/listas') }}" class="btn btn-secondary">Ver listas</a>
                            </div>
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
