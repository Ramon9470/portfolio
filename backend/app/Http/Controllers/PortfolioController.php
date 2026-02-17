<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Experience;

class PortfolioController extends Controller
{
    public function getPersonalInfos()
    {
        return response()->json([
            'full_name' => 'Ramon da Silva Ferreira',
            'title' => 'Desenvolvedor Full Stack & Analista de Sistemas',
            'summary' => 'Procuro uma oportunidade como analista para desenvolver minhas habilidades em análise de sistemas, banco de dados e administração de sistemas.',
            'github_url' => 'https://github.com/Ramon9470',
            'linkedin_url' => 'https://linkedin.com/in/ramon-ferreira-4a70723aa',
        ]);
    }

    public function getProjects()
    {
        $projects = Project::orderBy('order', 'asc')->get();
        return response()->json($projects);
    }

    public function getCourses()
    {
        return response()->json([
            [
                'title' => 'Análise e Desenvolvimento de Sistemas',
                'institution' => 'Faculdade X',
                'period' => '2024 - 2026',
                'description' => 'Graduação em andamento.'
            ],
            [
                'title' => 'Desenvolvimento Web Full Stack',
                'institution' => 'Udemy / Alura',
                'period' => '2025',
                'description' => 'Foco em Laravel, Angular e Docker.'
            ]
        ]);
    }
}