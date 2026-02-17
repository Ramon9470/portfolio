<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalInfo;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CVController extends Controller
{
    public function download()
    {
        $info = PersonalInfo::first();

        if (!$info){
            return response()->json(['error' => 'Nenhuma informação pessoal encontrada'], 404);
        }

        $info->skills = json_decode($info->skills ?? '[]');
        $info->languages = json_decode($info->languages ?? '[]');

        $courses = Course::orderBy('completion_date', 'desc')->get();
        $experiences = DB::table('experiences')->orderBy('id', 'asc')->get();

        $pdf = Pdf::loadView('pdf.cv-template', compact('info', 'courses', 'experiences'));        
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('Curriculo-Ramon-Ferreira.pdf');
    }
}