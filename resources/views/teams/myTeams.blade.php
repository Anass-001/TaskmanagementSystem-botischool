<!-- resources/views/teams/myTeams.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Mes Équipes</h1>
        {{-- @if ($teams->isEmpty())
            <div class="alert alert-warning" role="alert">
                Vous ne faites partie d'aucune équipe pour le moment.
            </div>
        @else --}}
        @foreach ($teams as $team)
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="card-title">{{ $team->name }}</h2>
                    <p class="card-text"><strong>Manager:</strong> {{ $team->manager->name }}</p>
                </div>
                <div class="card-body">
                    @if ($team->users->isEmpty())
                        <p>Aucun membre dans cette équipe.</p>
                    @else
                        <h5>Membres:</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($team->users as $member)
                                <li class="list-group-item">{{ $member->name }} </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @endforeach

    </div>
@endsection
