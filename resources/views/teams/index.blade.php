<!-- resources/views/teams/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des Équipes</h1>
        <a href="{{ route('teams.create') }}" class="btn btn-primary">Créer une Nouvelle Équipe</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Manager</th>
                    <th>Membres</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teams as $team)
                    <tr>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->manager->name }}</td>
                        <td>
                            @foreach ($team->users as $user)
                                {{ $user->name }}{{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('teams.show', $team->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette équipe ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
