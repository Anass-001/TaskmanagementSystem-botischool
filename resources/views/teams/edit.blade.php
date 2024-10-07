<!-- resources/views/teams/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier l'Équipe</h1>
        <form action="{{ route('teams.update', $team->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom de l'Équipe</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $team->name }}" required>
            </div>
            <div class="form-group">
                <label for="manager_id">Manager</label>
                <select class="form-control" id="manager_id" name="manager_id" required>
                    @foreach ($managers as $manager)
                        <option value="{{ $manager->id }}" {{ $manager->id == $team->manager_id ? 'selected' : '' }}>
                            {{ $manager->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_ids">Membres</label>
                <select class="form-control" id="user_ids" name="user_ids[]" multiple required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ in_array($user->id, $team->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection
