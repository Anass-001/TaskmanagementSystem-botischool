@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer un Nouvel Utilisateur</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>
            <div class="form-group">
                <label for="is_role">Rôle</label>
                <select class="form-control" id="is_role" name="is_role" required>
                    <option value="0">Utilisateur</option>
                    <option value="1">Manager</option>
                    <option value="2">Administrateur</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer l'Utilisateur</button>
        </form>
    </div>
@endsection
