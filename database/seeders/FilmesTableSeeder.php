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
                'anolancamento' => 'Ano de Lançamento: 2019',
                'descricao' => 'Marianne é uma jovem pintora na França do século 18, com a tarefa de pintar um retrato de Héloïse para seu casamento, sem que ela saiba. Passando seus dias observando Héloïse e as noites pintando, Marianne se vê cada vez mais próxima de sua modelo.',
                'avaliacao' => 4,
            ],
            [
                'titulo' => 'O Iluminado',
                'poster' => 'iluminado.png',
                'diretor' => 'Diretor: Stanley Kubrick',
                'anolancamento' => 'Ano de Lançamento: 1980',
                'descricao' => 'Jack Torrance se torna caseiro de inverno do isolado Hotel Overlook, nas montanhas do Colorado, na esperança de curar seu bloqueio de escritor. Ele se instala com a esposa Wendy e o filho Danny, que é atormentando por premonições. Jack não consegue escrever e as visões de Danny se tornam mais perturbadoras. O escritor descobre os segredos sombrios do hotel e começa a se transformar em um maníaco homicida, aterrorizando sua família.',
                'avaliacao' => 5,
            ],
            [
                'titulo' => 'Cisne Negro',
                'poster' => 'blackswan.jpg',
                'diretor' => 'Diretor: Darren Aronofsky',
                'anolancamento' => 'Ano de Lançamento: 2010',
                'descricao' => 'O enredo gira em torno de uma produção de O Lago dos Cisnes de Tchaikovsky pela companhia do New York City Ballet. Nina Sayers interpreta o Cisne Branco, e sua rival Lily representa o Cisne Negro. A pressão leva Nina a perder seu controle da realidade.',
                'avaliacao' => 4,
            ],
            [
                'titulo' => 'Que Horas Ela Volta?',
                'poster' => 'Que_horas_ela_volta_ver3_xlg.jpg',
                'diretor' => 'Diretora: Anna Muylaert',
                'anolancamento' => 'Ano de Lançamento: 2015',
                'descricao' => 'Val deixa a filha, Jéssica, no interior de Pernambuco e passa os 13 anos seguintes trabalhando como babá do menino Fabinho em São Paulo...',
                'avaliacao' => 4,
            ],
            [
                'titulo' => 'Pretty Woman',
                'poster' => 'prettywoman.jpg',
                'diretor' => 'Diretor: Garry Marshall',
                'anolancamento' => 'Ano de Lançamento: 1990',
                'descricao' => 'A história de Pretty Woman se concentra na prostituta de Hollywood Vivian Ward, que é contratada por um rico empresário, Edward Lewis...',
                'avaliacao' => 4,
            ],
            [
                'titulo' => 'Brilho Eterno de uma Mente Sem Lembranças',
                'poster' => 'brilhoeterno.jpg',
                'diretor' => 'Diretor: Michel Gondry',
                'anolancamento' => 'Ano de Lançamento: 2004',
                'descricao' => 'Joel conhece Clementine, que apagou suas memórias de um relacionamento anterior usando os serviços da Lacuna Inc...',
                'avaliacao' => 4,
            ],
            [
                'titulo' => 'Conto da Princesa Kaguya',
                'poster' => 'kaguya.jpg',
                'diretor' => 'Diretor: Isao Takahata',
                'anolancamento' => 'Ano de Lançamento: 2013',
                'descricao' => 'Kaguya é encontrada ainda bebê dentro de um tronco de bambu. Cresce rapidamente e enfrenta pretendentes com presentes impossíveis...',
                'avaliacao' => 4,
            ],
            [
                'titulo' => 'A Substância',
                'poster' => 'asubstanci.jpg',
                'diretor' => 'Diretora: Coralie Fargeat',
                'anolancamento' => 'Ano de Lançamento: 2024',
                'descricao' => 'Elisabeth Sparkle enfrenta um golpe devastador quando seu chefe a demite. Um laboratório oferece uma substância que promete aprimorá-la...',
                'avaliacao' => 4,
            ],
        ];

        foreach ($filmes as $filme) {
            Filme::create($filme);
        }
    }
}
