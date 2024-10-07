<?php

// app/Http/Controllers/TeamController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('manager', 'users')->get();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        $managers = User::where('is_role', 1)->get(); // Assuming 1 is the role ID for managers
        $users = User::where('is_role', 0)->get(); // Assuming 0 is the role ID for normal users
        return view('teams.create', compact('managers', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'manager_id' => 'required|exists:users,id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $team = Team::create([
            'name' => $request->name,
            'manager_id' => $request->manager_id,
        ]);

        $team->users()->sync($request->user_ids);

        return redirect()->route('teams.index')->with('success', 'Équipe créée avec succès.');
    }

    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        $managers = User::where('is_role', 1)->get();
        $users = User::where('is_role', 0)->get();
        return view('teams.edit', compact('team', 'managers', 'users'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'manager_id' => 'required|exists:users,id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $team->update([
            'name' => $request->name,
            'manager_id' => $request->manager_id,
        ]);

        $team->users()->sync($request->user_ids);

        return redirect()->route('teams.index')->with('success', 'Équipe modifiée avec succès.');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Équipe supprimée avec succès.');
    }

    public function myTeams()
    {
        $user = auth()->user();
        $teams = $user->teams; // Assuming there is a teams relationship on the User model
        return view('teams.myTeams', compact('teams'));
    }
}
