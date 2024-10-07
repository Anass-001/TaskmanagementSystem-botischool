<!-- resources/views/projects/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails du Projet</h1>
        <p><strong>Nom:</strong> {{ $project->name }}</p>
        <p><strong>Description:</strong> {{ $project->description }}</p>
        <p><strong>Date de Début:</strong> {{ $project->start_date }}</p>
        <p><strong>Date de Fin:</strong> {{ $project->end_date }}</p>
        <p><strong>Manager:</strong> {{ $project->manager->name }}</p>

        <h3>Équipes</h3>
        @if ($project->teams && $project->teams->isNotEmpty())
            <ul>
                @foreach ($project->teams as $team)
                    <li>{{ $team->name }}</li>
                @endforeach
            </ul>
        @else
            <p>Aucune équipe n'est associée à ce projet.</p>
        @endif
    </div>
@endsection
