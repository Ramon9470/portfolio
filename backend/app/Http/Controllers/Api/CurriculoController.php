<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InformacaoPessoal;
use App\Models\Curso;
use App\Models\Experiencia;
use Barryvdh\DomPDF\Facade\Pdf;

class CurriculoController extends Controller
{
    public function download()
    {
        $info = InformacaoPessoal::first();

        if (!$info) {
            return response()->json(['erro' => 'Nenhuma informação pessoal encontrada'], 404);
        }

        $cursos = Curso::orderBy('data_conclusao', 'desc')->get();
        $experiencias = Experiencia::orderBy('id', 'asc')->get();

        $pdf = Pdf::loadView('pdf.modelo-cv', compact('info', 'cursos', 'experiencias'));        
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Curriculo-Ramon-Ferreira.pdf');
    }
}