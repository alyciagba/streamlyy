@include('includes.header')

<main class="p-8">
    <h2 class="text-center text-4xl font-bold my-8">
        Seja bem-vindo ao Streamly, {{ Auth::check() ? Auth::user()->name : ($usuario ?? 'Convidado') }}!
    </h2>

    <div id="filmes-container" class="movie-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($filmes as $filme)
            @php
                // Support both Eloquent models and plain arrays/objects coming from JSON.
                $posterRaw = data_get($filme, 'poster');
                // Some data sources include the `images/` prefix; normalize to just the filename.
                $posterBase = $posterRaw ? preg_replace('/^images\//', '', $posterRaw) : null;

                // Determine which poster file actually exists in public/images/posters.
                $posterCandidates = [];
                if ($posterBase) {
                    $posterCandidates[] = $posterBase;
                    // Try common variants/extensions if the exact filename isn't present.
                    $posterCandidates[] = $posterBase . '.jpg';
                    $posterCandidates[] = $posterBase . '.png';
                    $posterCandidates[] = $posterBase . '.avif';
                    $posterCandidates[] = $posterBase . '.jpg.jpg';
                    $posterCandidates[] = preg_replace('/\.[^.]+$/', '.jpg', $posterBase); // replace ext with .jpg
                }

                $poster = null;
                foreach ($posterCandidates as $cand) {
                    if ($cand && file_exists(public_path('images/posters/' . $cand))) {
                        $poster = $cand;
                        break;
                    }
                }

                // If no candidate found, pick the first file in the posters folder as a fallback.
                if (!$poster) {
                    // Prefer a default.svg placeholder if available.
                    if (file_exists(public_path('images/posters/default.svg'))) {
                        $poster = 'default.svg';
                    } else {
                        $all = glob(public_path('images/posters/*')) ?: [];
                        if (!empty($all)) {
                            $poster = basename($all[0]);
                        } else {
                            // Final fallback: keep a null poster so view can handle missing image.
                            $poster = null;
                        }
                    }
                }

                $titulo = data_get($filme, 'titulo');
                $diretor = data_get($filme, 'diretor');
                $ano = data_get($filme, 'anolancamento') ?? data_get($filme, 'ano_lancamento');

                // Compute rating: if the $filme is an Eloquent model with usuarios relation, use pivot avg.
                if (is_object($filme) && method_exists($filme, 'usuarios')) {
                    try {
                        $media = $filme->usuarios()->avg('filme_user.avaliacao') ?? 0;
                    } catch (\Throwable $e) {
                        $media = 0;
                    }
                } else {
                    $media = data_get($filme, 'avaliacao', 0);
                }

                $filmeId = data_get($filme, 'id');
                $ranking = data_get($filme, 'ranking');
            @endphp

            <div class="movie-card bg-white p-4 rounded shadow flex flex-col items-center text-center">
                @if($poster)
                    <a href="{{ route('filmes.detalhes', $filmeId, false) }}" class="w-full block mb-3">
                        <img src="{{ asset('images/posters/' . $poster) }}" alt="Capa de {{ $titulo }}" class="w-full h-48 object-cover rounded">
                    </a>
                @endif

                <h3 class="text-lg font-semibold mb-2">{{ $titulo }}</h3>

                <div class="stars text-yellow-500 text-2xl">
                    @php $r = intval(round($ranking ?? 0)); if($r < 0) $r = 0; if($r > 5) $r = 5; @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= $r ? 'filled' : '' }}">★</span>
                    @endfor
                </div>

                <a href="{{ route('filmes.detalhes', $filmeId, false) }}" class="detalhes mt-3 block bg-blue-600 text-white px-4 py-1 rounded text-center">Detalhes</a>
            </div>
        @endforeach
    </div>
</main>

@include('includes.footer')
