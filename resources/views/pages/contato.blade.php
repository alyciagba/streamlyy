@include('includes.header')

<main class="contact-main p-8 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Contato dos Desenvolvedores</h2>

    <div class="contact-row flex flex-wrap gap-6">
        <div class="contact-person bg-white p-4 rounded shadow-md flex-1 min-w-[250px]">
            <img src="{{ asset('images/alycia2.jpg') }}" alt="Foto do Desenvolvedor 1" class="dev-photo mb-2 rounded">
            <h3 class="section-heading text-lg font-semibold mb-1">Alycia Tasla</h3>
            <p class="contact-desc mb-2">Programadora responsável pelo desenvolvimento do site.</p>
            <a class="contact-link text-blue-600 hover:underline" href="mailto:alycia.tasla.gba@email.com">Email</a> |
            <a class="contact-link text-blue-600 hover:underline" href="https://www.linkedin.com" target="_blank">LinkedIn</a>
        </div>

        <div class="contact-person bg-white p-4 rounded shadow-md flex-1 min-w-[250px]">
            <img src="{{ asset('images/evely.jpg') }}" alt="Foto do Desenvolvedor 2" class="dev-photo mb-2 rounded">
            <h3 class="section-heading text-lg font-semibold mb-1">Evely Thamires</h3>
            <p class="contact-desc mb-2">Gestora de ideias e responsável pela concepção do projeto.</p>
            <a class="contact-link text-blue-600 hover:underline" href="mailto:evelythamires001@email.com">Email</a> |
            <a class="contact-link text-blue-600 hover:underline" href="https://www.linkedin.com" target="_blank">LinkedIn</a>
        </div>
    </div>
</main>

@include('includes.footer')

<script src="{{ asset('js/script.js') }}" defer></script>
