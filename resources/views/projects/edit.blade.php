<!-- resources/views/projects/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le Projet</h1>
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom du Projet</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $project->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="start_date">Date de Début</label>
                <input type="date" class="form-control" id="start_date" name="start_date"
                    value="{{ $project->start_date }}" required>
            </div>
            <div class="form-group">
                <label for="end_date">Date de Fin</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $project->end_date }}"
                    required>
            </div>
            <div class="form-group">
                <label for="manager_id">Manager</label>
                <select class="form-control" id="manager_id" name="manager_id" required>
                    @foreach ($managers as $manager)
                        <option value="{{ $manager->id }}" {{ $project->manager_id == $manager->id ? 'selected' : '' }}>
                            {{ $manager->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="team_ids">Équipes</label>
                <select class="form-control" id="team_ids" name="team_ids[]" multiple required>
                    @foreach ($teams as $team)
                        <option value="{{ $team->id }}"
                            {{ in_array($team->id, $project->teams->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection
