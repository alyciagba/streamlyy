@include('includes.header')

<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-[#1a2a40] p-6 rounded-lg shadow-md">
        <div class="text-center">
            <h2 id="titulo" class="text-3xl font-bold mb-4 text-white">{{ $filme['titulo'] ?? '' }}</h2>
            <img id="poster" src="{{ asset($filme['poster'] ?? '') }}" 
                 class="mx-auto object-contain h-auto max-h-[500px] mb-4 rounded-lg shadow-md" 
                 alt="Poster do filme">
        </div>

        <p id="diretor" class="mb-4 text-gray-200">Diretor: {{ $filme['diretor'] ?? '' }}</p>
        <p id="anolancamento" class="mb-4 text-gray-200">Ano de lançamento: {{ $filme['anolancamento'] ?? '' }}</p>
        <p id="descricao" class="mb-4 text-gray-200">{{ $filme['descricao'] ?? '' }}</p>
        <p id="avaliacao" class="mb-4 font-semibold text-yellow-400">
            Avaliação: {{ $filme['avaliacao'] ?? '' }} ★
        </p>

        <div class="flex gap-4">
            <button id="adicionar" class="bg-blue-800 hover:bg-blue-900 text-white px-4 py-2 rounded">
                Adicionar como assistido
            </button>
            <button id="rankear" class="bg-blue-900 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Rankear
            </button>
        </div>
    </div>
</main>

@include('includes.footer')

@if(session('usuario') && session('usuario') !== 'Convidado')
<script>
    window.currentUser = @json(session('usuario'));
</script>
@endif

{{-- Script específico da página --}}
<script src="{{ asset('js/script.js') }}" defer></script>
