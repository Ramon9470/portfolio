<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso; 
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        return Curso::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validados = $request->validate([
            'titulo' => 'required|string|max:255',
            'instituicao' => 'required|string|max:255',
            'tipo' => 'required|string|max:100', 
            'status' => 'required|string|max:100',
            'certificado_url' => 'nullable|string|max:255',
            'data_inicio' => 'nullable|date',
            'data_conclusao' => 'nullable|date',
            'imagem' => 'nullable|image|max:2048',
            'certificado' => 'nullable|file|mimes:pdf,jpg,png|max:2048'
        ]);

        if ($request->hasFile('imagem')){
            $path = $request->file('imagem')->store('cursos', 'public');
            $validados['imagem_url'] = '/storage/' . $path;
        }

        if ($request->hasFile('certificado')){
            $path = $request->file('certificado')->store('certificados', 'public');
            $validados['certificado_url'] = '/storage/' . $path;
        }

        $curso = Curso::create($validados);
        return response()->json($curso, 201);
    }

    public function update(Request $request, $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->update($request->all());

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('cursos', 'public');
            $dados['imagem_url'] = '/storage/' . $path;
        }

        if ($request->hasFile('certificado')) {
            $path = $request->file('certificado')->store('certificados', 'public');
            $dados['certificado_url'] = '/storage/' . $path;
        }

        return response()->json($curso);
    }

    public function destroy($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();
        return response()->json(['mensagem' => 'Curso excluído']);
    }
}