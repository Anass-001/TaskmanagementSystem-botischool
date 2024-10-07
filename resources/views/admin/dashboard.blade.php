@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
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


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
