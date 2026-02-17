<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Limpa tabelas antigas
        DB::table('users')->truncate();
        DB::table('personal_infos')->truncate();
        DB::table('projects')->truncate();
        DB::table('courses')->truncate();
        DB::table('experiences')->truncate();

        User::create([
            'name' => 'Ramon Ferreira',
            'email' => 'ramon@admin.com',
            'password' => Hash::make('*9473@Ads'),
        ]);

        // Informações Pessoais
        DB::table('personal_infos')->insert([
            'full_name' => 'Ramon da Silva Ferreira',
            'title' => 'Desenvolvedor Full Stack & Analista de Sistemas',
            'summary' => 'Procuro uma oportunidade como analista para desenvolver minhas habilidades em análise de sistemas, banco de dados e administração de sistemas. Cursando Análise e Desenvolvimento de Sistemas e participando de formações em Web, Linux e Segurança da Informação.',
            'email' => 'ramon.ferreira.dev1@gmail.com',
            'phone' => '(83) 99928-4785',
            'city' => 'João Pessoa',
            'state' => 'PB',
            'profile_photo_url' => 'https://github.com/Ramon9470.png', 
            'github_url' => 'https://github.com/Ramon9470',
            'linkedin_url' => 'https://linkedin.com/in/ramon-ferreira', 
            'whatsapp_url' => 'https://wa.me/5583999284785',
            'skills' => json_encode(['PHP', 'Laravel', 'Angular', 'Docker', 'MySQL', 'Linux', 'Suporte TI', 'Redes']),
            'languages' => json_encode(['Português (Nativo)', 'Inglês (Técnico)']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Experiências
        DB::table('experiences')->insert([
            [
                'company' => 'RIX Telecom',
                'role' => 'Estágio Suporte em Redes',
                'period' => '27/10/2025 - 30/01/2026',
                'description' => 'Suporte técnico em infraestrutura de redes e atendimento ao cliente.'
            ],
            [
                'company' => 'Softcom Tecnologia',
                'role' => 'Técnico de Suporte',
                'period' => '01/05/2021 - 26/04/2025',
                'description' => 'Suporte especializado em sistemas, resolução de chamados e manutenção de software.'
            ],
            [
                'company' => 'Lojas Riachuelo',
                'role' => 'Operador de Caixa',
                'period' => '17/11/2020 - 14/02/2021',
                'description' => 'Atendimento ao cliente e processos financeiros.'
            ],
             [
                'company' => 'Hospital de Guarnição (Exército)',
                'role' => 'Militar (Técnico)',
                'period' => '01/01/2013 - 12/02/2014',
                'description' => 'Serviço militar obrigatório com foco em disciplina e processos.'
            ]
        ]);

        // Projetos
        $projects = [
            [
                'title' => 'Pet Mania',
                'slug' => 'pet-mania',
                'description' => 'Sistema completo para gestão de petshops. Inclui controle de agendamentos, cadastro de clientes e pets, e histórico médico.',
                'tech_stack' => json_encode(['Laravel', 'PHP', 'MySQL', 'Bootstrap']),
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Gerenciador OpenVPN GUI',
                'slug' => 'openvpn-gui',
                'description' => 'Aplicação Desktop desenvolvida em Python com CustomTkinter para gerenciar, iniciar e monitorar conexões VPN corporativas de forma visual.',
                'tech_stack' => json_encode(['Python', 'CustomTkinter', 'OpenVPN', 'Network']),
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Ponto Eletrônico Facial',
                'slug' => 'ponto-facial',
                'description' => 'Sistema de registro de ponto com reconhecimento facial e regras de negócio para turnos e intervalos.',
                'tech_stack' => json_encode(['PHP', 'JavaScript', 'Facial Recognition API']),
                'is_featured' => false,
                'order' => 3,
            ],
            [
                'title' => 'Extrator de Metadados EXIF',
                'slug' => 'meta-extractor',
                'description' => 'Script para extração forense de metadados de imagens, recuperando coordenadas GPS e dados da câmera.',
                'tech_stack' => json_encode(['Python', 'Pillow', 'Forensics']),
                'is_featured' => false,
                'order' => 4,
            ]
        ];

        foreach ($projects as $project) {
            DB::table('projects')->insert(array_merge($project, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }

        // Cursos
        $courses = [
            ['Análise e Desenvolvimento de Sistemas', 'Unipê', 'Graduação', 'Cursando', null],
            ['Fundamentos na Programação WEB', 'IFPB', 'Extensão', 'Concluído', 200],
            ['Administrando Banco de Dados', 'Fundação Bradesco', 'Curso Livre', 'Cursando', 15],
            ['NSE 1 Network Security Associate', 'FORTINET', 'Certificação', 'Concluído', null],
            ['Curso de Linux', 'Digital Innovation One', 'Curso Livre', 'Concluído', 15],
            ['Programação Banco de Dados com MySQL', 'Curso em Vídeo', 'Curso Livre', 'Concluído', 40]
        ];

        foreach ($courses as $c) {
            DB::table('courses')->insert([
                'name' => $c[0],
                'institution' => $c[1],
                'type' => $c[2],
                'status' => $c[3],
                'hours' => $c[4],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}