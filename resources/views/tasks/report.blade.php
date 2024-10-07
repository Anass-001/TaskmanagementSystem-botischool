<!-- report.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Rapport pour la tâche "{{ $task->name }}"</div>

                    <div class="card-body">
                        <form action="{{ route('tasks.report.submit', $task) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="report_content">Rapport</label>
                                <textarea class="form-control" id="report_content" name="report_content" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
