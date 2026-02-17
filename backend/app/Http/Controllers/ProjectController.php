<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::orderBy('order', 'asc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'tech_stack' => 'required|array',
            'image_url' => 'nullable|url',
            'repo_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'order' => 'integer'
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['tech_stack'] = json_encode($validated['tech_stack']);

        $project = Project::create($validated);

        return response()->json($project, 201);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'string',
            'description' => 'string',
            'tech_stack' => 'array',
            'image_url' => 'nullable|url',
            'repo_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'order' => 'integer'
        ]);

        if (isset($validated['title'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        }
        if (isset($validated['tech_stack'])) {
            $validated['tech_stack'] = json_encode($validated['tech_stack']);
        }

        $project->update($validated);

        return response()->json($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Projeto deletado']);
    }
}