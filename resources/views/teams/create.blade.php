<!-- resources/views/teams/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Créer une Nouvelle Équipe</h1>
        <form action="{{ route('teams.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom de l'Équipe</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="manager_id">Manager</label>
                <select class="form-control" id="manager_id" name="manager_id" required>
                    @foreach ($managers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_ids">Membres</label>
                <select class="form-control" id="user_ids" name="user_ids[]" multiple required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
@endsection
