<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s, color 0.3s;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #3490dc;
            color: #fff;
            text-align: center;
            font-weight: bold;
        }

        .card-body h5 {
            font-weight: bold;
            color: #3490dc;
        }

        .card-body img {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            width: 250px;
            background-image: url('../images/sincerely-media-p-NQlmGvFC8-unsplash.jpg');
            background-size: cover;
            background-position: center;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            border-right: 1px solid #ddd;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar-header {
            padding: 15px;
            text-align: center;
            background-color: #3490dc;
            color: #fff;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }

        .sidebar-profile {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar-profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .sidebar-profile h4 {
            margin: 0;
            font-size: 18px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #ddd;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        .dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .dark-mode .card-header {
            background-color: #1e1e1e;
        }

        .dark-mode .sidebar {
            background-color: #1e1e1e;
        }

        .dark-mode .sidebar ul li a {
            color: #e0e0e0;
        }

        .dark-mode .sidebar ul li a:hover {
            background-color: #333;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .dark-mode {
            background-color: #121212;
            color: #e0e0e0;
        }

        .dark-mode .card-header {
            background-color: #1e1e1e;
        }

        .dark-mode .sidebar {
            background-color: #1e1e1e;
        }

        .dark-mode .sidebar ul li a {
            color: #e0e0e0;
        }

        .dark-mode .sidebar ul li a:hover {
            background-color: #333;
        }

        .dark-mode .table {
            background-color: #1e1e1e;
            color: #e0e0e0;
        }

        .dark-mode .form-control {
            background-color: #2e2e2e;
            color: #e0e0e0;
            border-color: #555;
        }

        .dark-mode .form-control::placeholder {
            color: #aaa;
        }

        .navbar-brand {
            margin-left: 100px;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Task Management System BotiSchool
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <button id="dark-mode-toggle" class="btn btn-outline-secondary">Dark Mode</button>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ url('logout') }}" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="sidebar">
            <div class="sidebar-header">Task Management System</div>
            <div class="sidebar-profile">
                @if (auth()->user()->profile_photo)
                    <img src="http://localhost/TaskManagementSystem-BotiSchool{{ Storage::url('app/public/' . auth()->user()->profile_photo) }}"
                        class="rounded-circle mb-3" alt="Profile Photo"
                        style="width: 150px; height: 150px; border-radius: 50%;">
                @else
                    <img src="{{ asset('public/images/default-photo.jpg') }}" class="rounded-circle mb-3"
                        alt="Default Profile Photo" style="width: 150px; height: 150px;">
                @endif
                <h4>{{ Auth::user()->name }}</h4>
            </div>
            <ul>
                @if (Auth::user()->isUser())
                    <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('tasks.my_tasks') }}">Mes Tâches</a></li>
                    <li><a href="{{ route('teams.my_teams') }}">Mes Équipes</a></li>
                @endif

                @auth
                    @if (Auth::user()->isAdmin())
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('tasks.index') }}">Gestion Des Tâches</a></li>
                        <li><a href="{{ route('teams.index') }}">Gestion Des Équipes</a></li>
                        <li><a href="{{ route('projects.index') }}">Gestion Des Projets</a></li>
                        <li><a href="{{ route('users.index') }}">Gestion Des Utilisateurs</a></li>
                    @elseif (Auth::user()->isManager())
                        <li><a href="{{ route('manager.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('tasks.index') }}">Gestion Des Tâches</a></li>
                        <li><a href="{{ route('teams.index') }}">Gestion Des Équipes</a></li>
                        <li><a href="{{ route('projects.index') }}">Gestion Des Projets</a></li>
                    @endif
                    <li><a href="{{ route('profile.edit', auth()->user()->id) }}">Paramètres</a></li>
                    <li><a href="{{ url('logout') }}">Déconnexion</a></li>
                @endauth
            </ul>
        </div>

        <main class="content">
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const toggle = document.getElementById('dark-mode-toggle');
        const body = document.body;

        toggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            if (body.classList.contains('dark-mode')) {
                toggle.innerText = 'Light Mode';
            } else {
                toggle.innerText = 'Dark Mode';
            }
        });
    </script>
</body>

</html>
