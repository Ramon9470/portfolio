<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperienceController extends Controller
{
    public function index()
    {
        return DB::table('experiences')->orderBy('id', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string',
            'role' => 'required|string',
            'period' => 'required|string',
            'description' => 'nullable|string',
        ]);
        
        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        $id = DB::table('experiences')->insertGetId($validated);

        return response()->json(['id' => $id, ...$validated], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company' => 'string',
            'role' => 'string',
            'period' => 'string',
            'description' => 'nullable|string',
        ]);
        
        $validated['updated_at'] = now();

        DB::table('experiences')->where('id', $id)->update($validated);

        return response()->json(['message' => 'Atualizado com sucesso']);
    }

    public function destroy($id)
    {
        DB::table('experiences')->where('id', $id)->delete();
        return response()->json(['message' => 'Deletado com sucesso']);
    }
}