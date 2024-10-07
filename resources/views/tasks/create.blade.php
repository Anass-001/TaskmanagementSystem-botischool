<!-- resources/views/tasks/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer une Nouvelle Tâche</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="start_date">Date de début</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="end_date">Date de fin</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>En cours</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>
            <div class="form-group">
                <label for="project_id">Projet</label>
                <select class="form-control" id="project_id" name="project_id" required>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="assigned_user_id">Assigner à</label>
                <select class="form-control" id="assigned_user_id" name="assigned_user_id" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer la Tâche</button>
        </form>
    </div>
@endsection
