@include('includes.header')

<main class="p-8">
    <section class="max-w-3xl mx-auto bg-white p-6 rounded shadow-md listas-section">
        <h2 class="text-2xl font-bold mb-4">Suas Listas de Filmes</h2>

        @auth
            @if($listas->isEmpty())
                <p>Você ainda não criou nenhuma lista.</p>
            @else
                <div class="listas-grid">
                @foreach($listas as $lista)
                    <div class="lista-card">
                        <div class="lista-header">
                            <div>
                                <strong class="list-title">{{ $lista->nome }}</strong>
                                <div class="lista-meta">{{ $lista->filmes->count() }} filmes</div>
                            </div>
                            <div class="lista-actions">
                                <form method="POST" action="{{ route('listas.destroy', $lista->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-del">Excluir</button>
                                </form>
                            </div>
                        </div>
                        <div class="lista-divider"></div>

                        @if($lista->filmes->isEmpty())
                            <p class="lista-empty">Nenhum filme nesta lista.</p>
                        @else
                            <ul class="list-ul">
                                @foreach($lista->filmes as $filme)
                                    <li class="list-li">
                                        <div class="left">
                                            <span>{{ $filme->titulo }}</span>
                                        </div>
                                        <div class="right">
                                            <a href="{{ route('filmes.detalhes', $filme->id) }}" class="btn btn-small btn-secondary" title="Ver detalhes">Detalhes</a>
                                            <form method="POST" action="{{ route('listas.removeFilme', $lista->id) }}" style="display:inline-block; margin-left:0.5rem;">
                                                @csrf
                                                <input type="hidden" name="filme_id" value="{{ $filme->id }}">
                                                <button type="submit" class="btn btn-small btn-del">Remover</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="lista-divider"></div>
                        <form method="POST" action="{{ route('listas.addFilme', $lista) }}" class="lista-add-form flex gap-2 mt-2">
                            @csrf
                            <select name="filme_id" class="form-input p-2 border rounded flex-grow">
                                @foreach($todosFilmes as $filme)
                                    <option value="{{ $filme->id }}">{{ $filme->titulo }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </form>
                    </div>
                @endforeach
                </div>
            @endif

            {{-- Criar nova lista --}}
            <form method="POST" action="{{ route('listas.store') }}" class="flex gap-2 mt-4">
                @csrf
                <input name="nome" type="text" placeholder="Nome da nova lista" class="form-input p-2 border rounded flex-grow" />
                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Criar Lista</button>
            </form>
        @else
            <div class="p-6 bg-white rounded shadow listas-guest">
                <p class="mb-4">Você precisa fazer login ou se registrar para acessar suas listas pessoais.</p>
                <div class="flex gap-3">
                    <a href="{{ url('/login') }}" class="btn btn-primary">Entrar</a>
                    <a href="{{ route('cadastro') }}" class="btn btn-secondary">Cadastrar-se</a>
                </div>
            </div>
        @endauth
    </section>
</main>

@include('includes.footer')
