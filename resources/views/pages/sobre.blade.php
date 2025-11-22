@include('includes.header')

<main class="p-8">
    <section class="max-w-3xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4">Sobre o Streamly</h2>

        @if(session('usuario'))
            <p class="mb-4">Olá, {{ session('usuario') }}! Seja bem-vindo(a) ao Streamly.</p>
        @endif

        <div class="prose">
            <p><strong>Streamly</strong> nasceu da vontade de celebrar o cinema como experiência cultural. Mais do que uma coleção de títulos, Streamly foi idealizado como um espaço para preservar memórias de sessão, recomendações e pequenos comentários pessoais — um lugar onde quem ama filmes pode olhar, lembrar e partilhar sentimentos sobre as obras que marcaram sua trajetória.</p>

            <h3 class="section-heading">Nossa história</h3>
            <p>Originado como um projeto universitário, Streamly começou em salas de aula e encontros de grupo, quando duas estudantes decidiram transformar uma ideia simples em um trabalho prático: criar uma aplicação que valorizasse a relação pessoal com o cinema. O projeto cresceu dentro do contexto acadêmico, recebendo contribuições, debates e refinamentos que só um ambiente de aprendizagem proporciona. Essa raiz universitária marcou desde cedo a atenção ao design, à clareza e ao caráter reflexivo do produto.</p>

            <h3 class="section-heading">Os desenvolvedores</h3>
            <p>O Streamly foi idealizado e desenvolvido por duas colegas de curso: <strong>Alycia Tasla</strong> e <strong>Evely Thamires</strong>. Como estudantes, Alycia e Evely trouxeram para o projeto diferentes perspectivas — mistura de curiosidade técnica, sensibilidade estética e amor pelo cinema — e trabalharam de forma colaborativa para transformar o conceito inicial em um produto palpável. Seu trabalho reflete a experiência de quem cria em um ambiente de formação: experimental, cuidadoso e voltado ao aprendizado coletivo.</p>

            <h3 class="section-heading">Propósito</h3>
            <p>A missão do Streamly é oferecer um produto leve e humano: uma vitrine pessoal onde filmes são lembrados por emoções e contextos, não apenas por metadados. Buscamos inspirar a redescoberta — permitir que alguém volte a um título e relembre por que aquele filme foi importante, ou compartilhe essa descoberta com outros. Streamly valoriza a memória afetiva e a curadoria pessoal acima de algoritmos e modismos.</p>
        </div>
    </section>
</main>

@include('includes.footer')
