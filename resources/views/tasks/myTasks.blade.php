<!-- resources/views/mesTasks.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mes Tâches</h1>

        @if ($tasks->isEmpty())
            <p>Aucune tâche assignée pour le moment.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date de Début</th>
                        <th scope="col">Date de Fin</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Projet</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <th scope="row">{{ $task->id }}</th>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->start_date }}</td>
                            <td>{{ $task->end_date->format('Y-m-d') }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->project->name }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Modifier</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
