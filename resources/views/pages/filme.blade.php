@include('includes.header')

<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-[#1a2a40] p-6 rounded-lg shadow-md film-details">
        <div class="text-center">
            {{-- Title moved into the right column in the film-body for better layout --}}
            @php
                $posterRaw = data_get($filme, 'poster');
                $posterBase = $posterRaw ? preg_replace('/^images\//', '', $posterRaw) : null;
                $posterCandidates = [];
                if ($posterBase) {
                    $posterCandidates[] = $posterBase;
                    $posterCandidates[] = $posterBase . '.jpg';
                    $posterCandidates[] = $posterBase . '.png';
                    $posterCandidates[] = $posterBase . '.avif';
                    $posterCandidates[] = $posterBase . '.jpg.jpg';
                    $posterCandidates[] = preg_replace('/\.[^.]+$/', '.jpg', $posterBase);
                }

                $poster = null;
                foreach ($posterCandidates as $cand) {
                    if ($cand && file_exists(public_path('images/posters/' . $cand))) {
                        $poster = $cand;
                        break;
                    }
                }

                if (!$poster) {
                    if (file_exists(public_path('images/posters/default.svg'))) {
                        $poster = 'default.svg';
                    } else {
                        $all = glob(public_path('images/posters/*')) ?: [];
                        $poster = !empty($all) ? basename($all[0]) : null;
                    }
                }
            @endphp

            {{-- poster will be rendered in the left column below --}}

            <div class="film-body">
                <div class="poster-col">
                    {{-- left column: poster already rendered above for small screens; on wide screens this occupies column 1 --}}
                    @if($poster)
                        <img src="{{ asset('images/posters/' . $poster) }}" class="poster rounded-lg shadow-md" alt="Poster do filme">
                    @endif
                </div>

                <div class="film-info">
                    <h2 class="film-title">{{ $filme->titulo }}</h2>
            @php
                $ano = data_get($filme, 'ano_lancamento') ?? data_get($filme, 'anolancamento') ?? '';
            @endphp
                <p class="mb-2 text-gray-200 meta"><strong>Diretor:</strong> {{ $filme->diretor }}</p>
                @if($ano)
                    <p class="mb-2 text-gray-200 meta"><strong>Ano:</strong> {{ $ano }}</p>
                @endif
                <p class="mb-4 text-gray-200">{{ $filme->descricao }}</p>

                {{-- Comentários de todos os usuários (mostrados na mesma coluna) --}}
                <div class="mt-4">
                    <h3 class="text-lg font-semibold mb-2 text-white">Comentários de usuários</h3>

                    @if($filme->usuarios->isEmpty())
                        <p class="text-gray-300">Ainda não há comentários.</p>
                    @else
                        <ul class="space-y-2">
                            @foreach($filme->usuarios as $usuario)
                                <li class="comment-card">
                                    <div class="comment-author">{{ $usuario->nome }}</div>
                                    <div class="comment-meta">Nota: {{ $usuario->pivot->avaliacao ?? 'N/A' }} ★</div>
                                    <div class="mt-2">{{ $usuario->pivot->comentario ?? '-' }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Formulários de interação (ações centralizadas abaixo dos comentários) --}}
                @auth
                    <div class="mt-4">
                        <div class="film-actions">
                            {{-- Adicionar como assistido --}}
                            <form method="POST" action="{{ route('filmes.adicionar', $filme->id) }}">
                                @csrf
                                <button class="btn btn-primary">Adicionar como assistido</button>
                            </form>

                            {{-- Avaliar e comentar --}}
                            <form method="POST" action="{{ route('filmes.rankear', $filme->id) }}" class="flex gap-2 flex-wrap">
                                @csrf
                                <input type="number" name="avaliacao" min="1" max="5" placeholder="Nota" class="form-input" style="width:86px;" required>
                                <input type="text" name="comentario" placeholder="Comentário" class="form-input" style="min-width:220px;">
                                <button class="btn btn-primary">Rankear</button>
                            </form>
                        </div>

                        {{-- Adicionar à lista (separa abaixo das ações) --}}
                        <div class="mt-3 text-center">
                            @if(!$userListas->isEmpty())
                                <form method="POST" action="{{ route('listas.addFilme.generic') }}" class="flex gap-2 items-center justify-center">
                                    @csrf
                                    <input type="hidden" name="filme_id" value="{{ $filme->id }}">
                                    <select name="lista_id" class="form-input">
                                        @foreach($userListas as $l)
                                            <option value="{{ $l->id }}">{{ $l->nome }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-secondary">Adicionar à lista</button>
                                </form>
                            @else
                                <p class="text-sm text-gray-300">Você ainda não tem listas. <a href="{{ url('/listas') }}" class="text-blue-400 underline">Criar uma</a></p>
                            @endif
                        </div>
                    </div>
                @endauth
            </div>
    </div>
</main>

@include('includes.footer')
