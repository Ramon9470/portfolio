<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Experiencia;
use Illuminate\Http\Request;

class ExperienciaController extends Controller
{
    public function index()
    {
        return Experiencia::orderBy('id', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validados = $request->validate([
            'empresa' => 'required|string',
            'cargo' => 'required|string',
            'periodo' => 'required|string',
            'descricao' => 'nullable|string',
        ]);
        
        $experiencia = Experiencia::create($validados);

        return response()->json($experiencia, 201);
    }

    public function update(Request $request, $id)
    {
        $experiencia = Experiencia::findOrFail($id);
        
        $validados = $request->validate([
            'empresa' => 'string',
            'cargo' => 'string',
            'periodo' => 'string',
            'descricao' => 'nullable|string',
        ]);
        
        $experiencia->update($validados);

        return response()->json(['mensagem' => 'Experiência atualizada com sucesso']);
    }

    public function destroy($id)
    {
        $experiencia = Experiencia::findOrFail($id);
        $experiencia->delete();
        return response()->json(['mensagem' => 'Experiência deletada com sucesso']);
    }
}