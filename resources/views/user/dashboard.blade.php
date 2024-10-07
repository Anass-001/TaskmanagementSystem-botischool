@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Tableau de Bord</div>
                    <div class="card-body text-center">
                        <h5>Bienvenue, {{ Auth::user()->name }}!</h5>
                        @if (auth()->user()->profile_photo)
                            <img src="http://localhost/TaskManagementSystem-BotiSchool{{ Storage::url('app/public/' . auth()->user()->profile_photo) }}"
                                class="rounded-circle mb-3" alt="Profile Photo"
                                style="width: 150px; height: 150px; border-radius: 50%;">
                        @else
                            <img src="{{ asset('public/images/default-photo.jpg') }}" class="rounded-circle mb-3"
                                alt="Default Profile Photo" style="width: 150px; height: 150px;">
                        @endif
                        <p>Date d'aujourd'hui : {{ now()->format('d/m/Y') }}</p>
                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white bg-warning mb-3">
                                    <div class="card-header">Tâches en attente</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $tasksPending }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-header">Tâches en cours</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $tasksInProgress }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-header">Tâches terminées</div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $tasksCompleted }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($tasksAlert->count() > 0)
                            <div class="alert alert-danger" role="alert">
                                <h4 class="alert-heading">Tâches à terminer bientôt</h4>
                                <ul>
                                    @foreach ($tasksAlert as $task)
                                        <li>{{ $task->name }} - Due: {{ $task->end_date->format('Y-m-d') }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
