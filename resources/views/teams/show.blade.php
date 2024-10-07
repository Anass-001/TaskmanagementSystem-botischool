<!-- resources/views/teams/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails de l'Équipe</h1>
        <p><strong>Nom:</strong> {{ $team->name }}</p>
        <p><strong>Manager:</strong> {{ $team->manager->name }}</p>
        <h3>Membres</h3>
        <ul>
            @foreach ($team->users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
