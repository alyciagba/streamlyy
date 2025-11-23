<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filme;

class FilmesTableSeeder extends Seeder
{
    public function run()
    {
        $filmes = [
            [
                'titulo' => 'Retrato de uma Jovem em Chamas',
                'poster' => 'jovememchamas.jpg',
                'diretor' => 'Diretora: Céline Sciamma',
                'ano_lancamento' => 'Ano de Lançamento: 2019',
                'ranking' => 4,
                'descricao' => 'Marianne é uma jovem pintora na França do século 18, com a tarefa de pintar um retrato de Héloïse para seu casamento, sem que ela saiba. Passando seus dias observando Héloïse e as noites pintando, Marianne se vê cada vez mais próxima de sua modelo.',
            ],
            [
                'titulo' => 'O Iluminado',
                'poster' => 'iluminado.png',
                'diretor' => 'Diretor: Stanley Kubrick',
                'ano_lancamento' => 'Ano de Lançamento: 1980',
                'ranking' => 5,
                'descricao' => 'Jack Torrance se torna caseiro de inverno do isolado Hotel Overlook, nas montanhas do Colorado, na esperança de curar seu bloqueio de escritor. Ele se instala com a esposa Wendy e o filho Danny, que é atormentando por premonições. Jack não consegue escrever e as visões de Danny se tornam mais perturbadoras. O escritor descobre os segredos sombrios do hotel e começa a se transformar em um maníaco homicida, aterrorizando sua família.',
            ],
            [
                'titulo' => 'Cisne Negro',
                'poster' => 'blackswan.jpg',
                'diretor' => 'Diretor: Darren Aronofsky',
                'ano_lancamento' => 'Ano de Lançamento: 2010',
                'ranking' => 4,
                'descricao' => 'O enredo gira em torno de uma produção de O Lago dos Cisnes de Tchaikovsky pela companhia do New York City Ballet. Nina Sayers interpreta o Cisne Branco, e sua rival Lily representa o Cisne Negro. A pressão leva Nina a perder seu controle da realidade.',
            ],
            [
                'titulo' => 'Que Horas Ela Volta?',
                'poster' => 'Que_horas_ela_volta_ver3_xlg.jpg',
                'diretor' => 'Diretora: Anna Muylaert',
                'ano_lancamento' => 'Ano de Lançamento: 2015',
                'ranking' => 4,
                'descricao' => 'Val deixa a filha, Jéssica, no interior de Pernambuco e passa os 13 anos seguintes trabalhando como babá do menino Fabinho em São Paulo. Ela consegue estabilidade financeira, mas convive com a culpa por não ter criado sua filha. Às vésperas do vestibular de Fabinho, Jéssica decide ir para São Paulo e fazer a prova também. Val recebe o apoio de seus patrões para receber a garota, mas a convivência com é difícil. Dividida, ela precisa achar um novo modo de seguir sua vida.',
            ],
            [
                'titulo' => 'Pretty Woman',
                'poster' => 'prettywoman.jpg',
                'diretor' => 'Diretor: Garry Marshall',
                'ano_lancamento' => 'Ano de Lançamento: 1990',
                'ranking' => 4,
                'descricao' => 'Uma bela prostituta que trabalha no Hollywood Boulevard recebe ajuda de um rico homem de negócios e acaba sendo contratada por uma semana. No período, torna-se uma jovem elegante que o acompanha em seus compromissos sociais, mas ambos se envolvem e a relação entre o patrão e o empregado se transforma num relacionamento entre homem e mulher.',
            ],
            [
                'titulo' => 'Brilho Eterno de uma Mente Sem Lembranças',
                'poster' => 'brilhoeterno.jpg',
                'diretor' => 'Diretor: Michel Gondry',
                'ano_lancamento' => 'Ano de Lançamento: 2004',
                'ranking' => 4,
                'descricao' => 'Joel se surpreende ao saber que seu amor verdadeiro, Clementine, o apagou completamente de sua memória. Ele decide fazer o mesmo, mas muda de ideia. Preso dentro da própria mente enquanto os especialistas se mantêm ocupados em seu apartamento, Joel precisa avisá-los para parar.',
            ],
            [
                'titulo' => 'Conto da Princesa Kaguya',
                'poster' => 'kaguya.jpg',
                'diretor' => 'Diretor: Isao Takahata',
                'ano_lancamento' => 'Ano de Lançamento: 2013',
                'ranking' => 4,
                'descricao' => 'O conto narra a história de uma misteriosa garota encontrada por um cortador de bambu dentro de um caule brilhante. Ela cresce rapidamente, tornando-se uma bela jovem desejada por cinco nobres e pelo imperador, a quem ela rejeita ao lhes enviar tarefas impossíveis. Ela reluta em aceitar a vida luxuosa que seus pais adotivos lhe impõem, anseia pela vida simples que teve na infância e eventualmente revela que é de origem lunar e deve retornar ao seu planeta.',
            ],
            [
                'titulo' => 'A Substância',
                'poster' => 'asubstanci.jpg',
                'diretor' => 'Diretora: Coralie Fargeat',
                'ano_lancamento' => 'Ano de Lançamento: 2024',
                'ranking' => 4,
                'descricao' => 'Elisabeth Sparkle (Demi Moore), uma celebridade em declínio que usa uma droga ilegal que replica células, criando temporariamente uma versão mais jovem e aprimorada de si mesma, chamada Sue (Margaret Qualley). As duas versões precisam dividir o tempo, com consequências chocantes quando a regra é violada.',
            ],
        ];

        foreach ($filmes as $filme) {
            // Use updateOrCreate so running the seeder updates existing records instead of duplicating
            Filme::updateOrCreate(
                ['titulo' => $filme['titulo']],
                $filme
            );
        }
    }
}
