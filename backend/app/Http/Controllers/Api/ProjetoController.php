<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjetoController extends Controller
{
    public function index()
    {
        return Projeto::orderBy('ordem', 'asc')->get();
    }

    public function store(Request $request)
    {
        $validados = $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'required|string',
            'tecnologias' => 'required',
            'imagem' => 'nullable|image|max:2048',
            'repo_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'ordem' => 'integer'
        ]);

        $validados['slug'] = Str::slug($validados['titulo']);
        if (Projeto::where('slug', $validados['slug'])->exists()) {
             return response()->json(['message' => 'Já existe um projeto com este título.'], 422);
        }

        if (isset($validados['tecnologias']) && is_string($validados['tecnologias'])) {
            $validados['tecnologias'] = array_map('trim', explode(',', $validados['tecnologias']));
        }

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('projetos', 'public');
            $validados['imagem_url'] = '/storage/' . $path;
        }

        $projeto = Projeto::create($validados);
        return response()->json($projeto, 201);
    }

    public function update(Request $request, $id)
    {
        $projeto = Projeto::findOrFail($id);
        
        $dados = $request->all();

        if (isset($dados['titulo'])) {
            $novoSlug = Str::slug($dados['titulo']);
            if ($novoSlug !== $projeto->slug) {
                if (Projeto::where('slug', $novoSlug)->where('id', '!=', $id)->exists()) {
                    return response()->json(['message' => 'Título em uso.'], 422);
                }
                $dados['slug'] = $novoSlug;
            }
        }

        if (isset($dados['tecnologias']) && is_string($dados['tecnologias'])) {
            $dados['tecnologias'] = array_map('trim', explode(',', $dados['tecnologias']));
        }

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('projetos', 'public');
            $dados['imagem_url'] = '/storage/' . $path;
        }

        $projeto->update($dados);
        return response()->json($projeto);
    }

    public function destroy($id)
    {
        $projeto = Projeto::findOrFail($id);
        $projeto->delete();
        return response()->json(['mensagem' => 'Projeto deletado com sucesso']);
    }
}