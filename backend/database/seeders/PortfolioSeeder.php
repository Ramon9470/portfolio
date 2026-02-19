<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\Models\Projeto;
use App\Models\Experiencia;
use App\Models\Curso;
use App\Models\InformacaoPessoal;
use Illuminate\Support\Facades\Hash;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('TRUNCATE usuarios, informacoes_pessoais, projetos, cursos, experiencias RESTART IDENTITY CASCADE');

        Usuario::create([
            'nome' => 'Ramon Ferreira',
            'email' => 'ramon@admin.com',
            'password' => Hash::make('r4m0N123@'),
        ]);

        InformacaoPessoal::create([
            'nome_completo' => 'Ramon da Silva Ferreira',
            'titulo' => 'Desenvolvedor Full Stack & Analista de Sistemas',
            'resumo' => 'Procuro uma oportunidade como analista para desenvolver minhas habilidades em análise de sistemas, banco de dados e administração de sistemas. Cursando Análise e Desenvolvimento de Sistemas.',
            'email' => 'ramon.ferreira.dev1@gmail.com',
            'telefone' => '(83) 99928-4785',
            'cidade' => 'João Pessoa',
            'estado' => 'PB',
            'perfil_foto_url' => 'https://github.com/Ramon9470.png', 
            'github_url' => 'https://github.com/Ramon9470',
            'linkedin_url' => 'https://linkedin.com/in/ramon-ferreira', 
            'whatsapp_url' => 'https://wa.me/5583999284785',
            'habilidades' => ['PHP', 'Laravel', 'Angular', 'Docker', 'PostgreSQL', 'Linux', 'C#', 'Rust'],
            'idiomas' => ['Português (Nativo)', 'Inglês (Técnico)'],
        ]);

        $experiencias = [
            [
                'empresa' => 'RIX Telecom',
                'cargo' => 'Estágio Suporte em Redes',
                'periodo' => '2025 - 2026',
                'descricao' => 'Suporte técnico em infraestrutura de redes e atendimento ao cliente.'
            ],
            [
                'empresa' => 'Softcom Tecnologia',
                'cargo' => 'Técnico de Suporte',
                'periodo' => '2021 - 2025',
                'descricao' => 'Suporte especializado em sistemas e manutenção de software.'
            ]
        ];

        foreach ($experiencias as $exp) {
            Experiencia::create($exp);
        }

        // Projetos (Chaves em português)
        $projetos = [
            [
                'titulo' => 'Pet Mania',
                'slug' => 'pet-mania',
                'descricao' => 'Sistema completo para gestão de petshops com Laravel e PostgreSQL.',
                'tecnologias' => ['Laravel', 'PHP', 'PostgreSQL', 'Bootstrap'],
                'ordem' => 1,
            ],
            [
                'titulo' => 'Ponto Eletrônico Facial',
                'slug' => 'ponto-facial',
                'descricao' => 'Registro de ponto com reconhecimento facial.',
                'tecnologias' => ['PHP', 'JavaScript', 'Python'],
                'ordem' => 2,
            ]
        ];

        foreach ($projetos as $projeto) {
            Projeto::create($projeto);
        }

        // Cursos
        $cursos = [
            [
                'titulo' => 'Análise e Desenvolvimento de Sistemas',
                'instituicao' => 'Unipê',
                'tipo' => 'Graduação',
                'status' => 'Cursando'
            ],
            [
                'titulo' => 'NSE 1 Network Security Associate',
                'instituicao' => 'FORTINET',
                'tipo' => 'Certificação',
                'status' => 'Concluído'
            ]
        ];

        foreach ($cursos as $curso) {
            Curso::create($curso);
        }
    }
}