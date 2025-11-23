@include('includes.header')

<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-[#1a2a40] p-6 rounded-lg shadow-md film-details">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-4 text-white">{{ $filme->titulo }}</h2>
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

            @if($poster)
                <img src="{{ asset('images/posters/' . $poster) }}"
                     class="poster mb-4 rounded-lg shadow-md"
                     alt="Poster do filme">
            @else
                <div class="mx-auto w-full h-80 bg-gray-700 rounded flex items-center justify-center text-white">Sem imagem</div>
            @endif
        </div>

        <div class="film-info">
            @php
                $ano = data_get($filme, 'ano_lancamento') ?? data_get($filme, 'anolancamento') ?? '';
            @endphp
            <p class="mb-4 text-gray-200">{{ $filme->diretor }}</p>
            @if($ano)
                <p class="mb-4 text-gray-200">{{ $ano }}</p>
            @endif
            <p class="mb-4 text-gray-200">{{ $filme->descricao }}</p>
        </div>

        {{-- Formulários de interação --}}
        @auth
            <div class="flex gap-4 mb-6 flex-wrap">
                {{-- Adicionar como assistido --}}
                <form method="POST" action="{{ route('filmes.adicionar', $filme->id) }}">
                    @csrf
                    <button class="bg-blue-800 hover:bg-blue-900 text-white px-4 py-2 rounded">
                        Adicionar como assistido
                    </button>
                </form>

                {{-- Avaliar e comentar --}}
                <form method="POST" action="{{ route('filmes.rankear', $filme->id) }}" class="flex gap-2 flex-wrap">
                    @csrf
                    <input type="number" name="avaliacao" min="1" max="5" placeholder="Nota" class="w-16 p-1 rounded" required>
                    <input type="text" name="comentario" placeholder="Comentário" class="p-1 rounded flex-grow">
                    <button class="bg-blue-900 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Rankear
                    </button>
                </form>
                
                {{-- Adicionar a uma lista existente --}}
                @if(!$userListas->isEmpty())
                    <form method="POST" action="{{ route('listas.addFilme.generic') }}" class="flex gap-2 items-center">
                        @csrf
                        <input type="hidden" name="filme_id" value="{{ $filme->id }}">
                        <select name="lista_id" class="p-1 border rounded">
                            @foreach($userListas as $l)
                                <option value="{{ $l->id }}">{{ $l->nome }}</option>
                            @endforeach
                        </select>
                        <button class="bg-green-600 text-white px-3 py-1 rounded">Adicionar à lista</button>
                    </form>
                @else
                    <p class="text-sm text-gray-300">Você ainda não tem listas. <a href="{{ url('/listas') }}" class="text-blue-400 underline">Criar uma</a></p>
                @endif
            </div>
        @endauth

        {{-- Comentários de todos os usuários --}}
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2 text-white">Comentários de usuários</h3>

            @if($filme->usuarios->isEmpty())
                <p class="text-gray-300">Ainda não há comentários.</p>
            @else
                <ul class="space-y-2">
                    @foreach($filme->usuarios as $usuario)
                        <li class="p-2 bg-gray-800 rounded">
                            <strong>{{ $usuario->nome }}</strong>: {{ $usuario->pivot->comentario ?? '-' }}
                            <br>
                            Nota: {{ $usuario->pivot->avaliacao ?? 'N/A' }} ★
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</main>

@include('includes.footer')
