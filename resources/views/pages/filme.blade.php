@include('includes.header')

<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-[#1a2a40] p-6 rounded-lg shadow-md">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-4 text-white">{{ $filme->titulo }}</h2>
            <img src="{{ asset('images/posters/' . $filme->poster) }}" 
                 class="mx-auto object-contain h-auto max-h-[500px] mb-4 rounded-lg shadow-md" 
                 alt="Poster do filme">
        </div>

        <p class="mb-4 text-gray-200">{{ $filme->diretor }}</p>
        <p class="mb-4 text-gray-200">{{ $filme->anolancamento }}</p>
        <p class="mb-4 text-gray-200">{{ $filme->descricao }}</p>

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
