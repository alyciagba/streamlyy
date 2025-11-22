@php
    $usuarioLogado = session('usuario', 'Convidado');
@endphp

<header class="site-header flex justify-between items-center p-4 bg-gray-100">
    <span class="text-2xl font-bold tracking-wide">Streamly</span>

    <nav class="space-x-4">
        <a href="{{ url('/') }}" class="hover:underline">Home</a>
        <a href="{{ url('/sobre') }}" class="hover:underline">Sobre</a>
        <a href="{{ url('/contato') }}" class="hover:underline">Contato</a>
        <a href="{{ url('/listas') }}" class="hover:underline">Listas</a>
        <a href="{{ url('/perfil') }}" class="hover:underline">Perfil</a>

        @if($usuarioLogado !== 'Convidado')
            <a href="{{ route('logout') }}" class="hover:underline">Logout ({{ $usuarioLogado }})</a>
        @else
            <a href="{{ url('/login') }}" class="hover:underline">Login</a>
        @endif
    </nav>
</header>

{{-- Passa os filmes para JS se existirem --}}
@if(isset($filmes) && is_array($filmes))
<script>
    try {
        window.filmes = @json($filmes, JSON_UNESCAPED_UNICODE);
    } catch(e) {}
</script>
@endif
