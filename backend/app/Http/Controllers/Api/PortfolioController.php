<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projeto;
use App\Models\InformacaoPessoal;
use App\Models\Curso;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function getInformacoesPessoais()
    {
        $info = InformacaoPessoal::first();

        return response()->json($info ?? []);
    }

    public function getProjetos()
    {
        return response()->json(Projeto::orderBy('ordem', 'asc')->get());
    }

    public function getCursos()
    {
        $cursos = Curso::orderBy('data_conclusao', 'desc')->get();
        
        if ($cursos->isEmpty()) {
            return response()->json([
                [
                    'titulo' => 'Análise e Desenvolvimento de Sistemas',
                    'instituicao' => 'Faculdade X',
                    'periodo' => '2024 - 2026',
                    'descricao' => 'Graduação em andamento.'
                ]
            ]);
        }

        return response()->json($cursos);
    }

    public function updateInformacoesPessoais(Request $request)
    {
        $info = InformacaoPessoal::first();
        
        if (!$info) {
            $info = new InformacaoPessoal();
        }

        $validados = $request->validate([
            'nome_completo' => 'required|string',
            'titulo' => 'nullable|string',
            'resumo' => 'nullable|string',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'cidade' => 'nullable|string',
            'estado' => 'nullable|string',
            'linkedin_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'whatsapp_url' => 'nullable|string',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('perfil', 'public');
            $validados['perfil_foto_url'] = '/storage/' . $path;
        }

        $info->fill($validados);
        $info->save();

        return response()->json($info);
    }
}