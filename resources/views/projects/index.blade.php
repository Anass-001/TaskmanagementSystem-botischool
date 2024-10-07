<!-- resources/views/projects/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des Projets</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Créer un Nouveau Projet</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Manager</th>
                    <th>Équipes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->end_date }}</td>
                        <td>{{ $project->manager->name }}</td>
                        <td>
                            @foreach ($project->teams as $team)
                                {{ $team->name }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
