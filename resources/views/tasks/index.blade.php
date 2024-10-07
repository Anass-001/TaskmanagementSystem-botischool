@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Mes Tâches</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Bouton pour créer une nouvelle tâche -->
                        <div class="mb-3">
                            <a href="{{ route('tasks.create') }}" class="btn btn-success">Créer une nouvelle tâche</a>
                        </div>

                        <!-- Formulaire de filtre -->
                        <form method="GET" action="{{ route('tasks.index') }}" class="mb-3">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <select name="assigned_user_id" class="form-control">
                                        <option value="">Sélectionner un utilisateur</option>
                                        @foreach ($assigned as $user)
                                            <option value="{{ $user->id }}"
                                                {{ request('assigned_user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Filtrer</button>
                                </div>
                            </div>
                        </form>

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
                                    <th scope="col">Assigné à</th>
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
                                        <td>
                                            @if ($task->project)
                                                {{ $task->project->name }}
                                            @else
                                                Aucun projet associé
                                            @endif
                                        </td>

                                        <td>{{ $task->assignedUser->name ?? 'Non assigné' }}</td>
                                        <td>
                                            <a href="{{ route('tasks.edit', $task->id) }}"
                                                class="btn btn-primary">Modifier</a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
