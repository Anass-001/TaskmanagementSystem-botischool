@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des Utilisateurs</h1>
        <table class="table mt-4">
            <thead>
                <tr>
                    <div class="mb-3">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
                    </div>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->is_role == 0)
                                Utilisateur
                            @elseif($user->is_role == 1)
                                Manager
                            @elseif($user->is_role == 2)
                                Administrateur
                            @endif
                        </td>
                        <td>
                            <!-- Ajoutez des actions, par exemple, Éditer, Supprimer -->
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
