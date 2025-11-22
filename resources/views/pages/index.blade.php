@include('includes.header')

<main class="p-8">
    <h2 class="text-center text-4xl font-bold my-8">
        Seja bem-vindo ao Streamly, {{ $usuario }}!
    </h2>

    <div id="filmes-container" class="movie-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($filmes as $filme)
            <div class="movie-card bg-white p-4 rounded shadow">
                <img src="{{ asset($filme['poster']) }}" alt="Capa do filme" class="w-full h-60 object-cover rounded">

                <h3 class="text-lg font-semibold mt-2">{{ $filme['titulo'] }}</h3>
                <p class="text-sm text-gray-600">{{ $filme['diretor'] }}</p>
                <p class="text-sm text-gray-600">{{ $filme['anolancamento'] }}</p>

                <div class="mt-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= $filme['avaliacao'] ? 'filled' : '' }}">★</span>
                    @endfor
                </div>

                <button
                    onclick="window.location.href='{{ url("/filmes/{$filmes['id']}") }}'"
                    class="mt-2 bg-blue-600 text-white px-4 py-1 rounded w-full">
                    Detalhes
                </button>
            </div>
        @endforeach
    </div>
</main>

@include('includes.footer')
