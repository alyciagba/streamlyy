<header class="site-header flex justify-between items-center p-4 bg-gray-100">
    <span class="text-2xl font-bold tracking-wide">Streamly</span>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <nav class="space-x-4 flex items-center">
        <a href="{{ url('/') }}" class="hover:underline">Home</a>
        <a href="{{ url('/sobre') }}" class="hover:underline">Sobre</a>
        <a href="{{ url('/contato') }}" class="hover:underline">Contato</a>
        <a href="{{ url('/listas') }}" class="hover:underline">Listas</a>
        <a href="{{ url('/perfil') }}" class="hover:underline">Perfil</a>

        @auth
            @php $user = Auth::user(); @endphp
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="hover:underline bg-transparent border-0 p-0">Logout</button>
            </form>
            <span class="ml-3 flex items-center">
                <img src="{{ asset('images/users/' . ($user->foto ?? 'perfil.png')) }}" alt="avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                <span class="font-medium">{{ $user->name }}</span>
            </span>
        @endauth

        @guest
            <a href="{{ url('/login') }}" class="hover:underline">Login</a>
            <a href="{{ route('cadastro') }}" class="hover:underline">Cadastro</a>
        @endguest
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
