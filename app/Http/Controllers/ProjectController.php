<?php

// app/Http/Controllers/ProjectController.php
// app/Http/Controllers/ProjectController.php
// app/Http/Controllers/ProjectController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Team;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['manager', 'teams'])->get(); // Include manager and teams relationships
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $managers = User::where('is_role', 1)->get(); // Assuming 1 is the role ID for managers
        $teams = Team::all();
        return view('projects.create', compact('managers', 'teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'manager_id' => 'required|exists:users,id',
            'team_ids' => 'required|array',
            'team_ids.*' => 'exists:teams,id',
        ]);

        $project = Project::create($request->only(['name', 'description', 'start_date', 'end_date', 'manager_id']));

        // Sync teams with the project
        $project->teams()->sync($request->team_ids);

        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès.');
    }

    public function show(Project $project)
    {
        $project->load('teams'); // Eager load teams relationship
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $managers = User::where('is_role', 1)->get();
        $teams = Team::all();
        return view('projects.edit', compact('project', 'managers', 'teams'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'manager_id' => 'required|exists:users,id',
            'team_ids' => 'required|array',
            'team_ids.*' => 'exists:teams,id',
        ]);

        $project->update($request->only(['name', 'description', 'start_date', 'end_date', 'manager_id']));

        // Sync teams with the project
        $project->teams()->sync($request->team_ids);

        return redirect()->route('projects.index')->with('success', 'Projet modifié avec succès.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Projet supprimé avec succès.');
    }
}
