@include('includes.header')

<main class="p-8">
    <section class="max-w-3xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4">Suas Listas de Filmes</h2>

        @auth
            @forelse($listas as $lista)
                <div class="p-3 bg-gray-100 rounded shadow mb-4">
                    {{-- Cabeçalho da lista --}}
                    <div class="flex justify-between items-center mb-2">
                        <strong>{{ $lista->nome }}</strong>
                        <form method="POST" action="{{ route('listas.destroy', $lista->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                        </form>
                    </div>

                    {{-- Filmes da lista --}}
                    @if($lista->filmes->isEmpty())
                        <p class="text-sm text-gray-600">Nenhum filme nesta lista.</p>
                    @else
                        <ul class="ml-4 list-disc">
                            @foreach($lista->filmes as $filme)
                                <li class="flex justify-between items-center mb-1">
                                    {{ $filme->titulo }}
                                    <form method="POST" action="{{ route('listas.removeFilme', $lista->id) }}">
                                        @csrf
                                        <input type="hidden" name="filme_id" value="{{ $filme->id }}">
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Remover</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Adicionar filme à lista --}}
                    <form method="POST" action="{{ route('listas.addFilme', $lista) }}" class="flex gap-2 mt-2">
                        @csrf
                        <select name="filme_id" class="form-input p-2 border rounded flex-grow">
                            @foreach($todosFilmes as $filme)
                                <option value="{{ $filme->id }}">{{ $filme->titulo }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Adicionar Filme</button>
                    </form>
                </div>
            @empty
                <p>Você ainda não criou nenhuma lista.</p>
            @endforelse

            {{-- Criar nova lista --}}
            <form method="POST" action="{{ route('listas.store') }}" class="flex gap-2 mt-4">
                @csrf
                <input name="nome" type="text" placeholder="Nome da nova lista" class="form-input p-2 border rounded flex-grow" />
                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Criar Lista</button>
            </form>
        @else
            <div class="p-6 bg-white rounded shadow">
                <p class="mb-4">Você precisa fazer login ou se registrar para acessar suas listas pessoais.</p>
                <div class="flex gap-3">
                    <a href="{{ url('/login') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Entrar</a>
                    <a href="{{ route('cadastro') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded">Cadastrar-se</a>
                </div>
            </div>
        @endauth
    </section>
</main>

@include('includes.footer')
