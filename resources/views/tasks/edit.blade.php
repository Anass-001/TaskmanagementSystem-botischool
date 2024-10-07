@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier la Tâche</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $task->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="start_date">Date de Début</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $task->start_date }}"
                    required>
            </div>
            <div class="form-group">
                <label for="end_date">Date de Fin</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $task->end_date }}"
                    required>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="project_id">Projet</label>
                <select class="form-control" id="project_id" name="project_id" required>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
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
            <button type="submit" class="btn btn-primary">Mettre à Jour</button>
        </form>
    </div>
@endsection
