<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wekcome Page TMS</title>
    <link rel="stylesheet" href="{{ url('public/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body>

    <div class="wrapper">

        <div class="logo"><img src="public/images/logo.png" alt="logo"></div>
        <form action="">
            @if (Auth::check())
                <a href="{{ url('/manager/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Dashboard
                </a>
            @else
                <div class="rectangle">
                    <div class="loginLink"><a href="{{ url('login') }}">
                            <h1>Log In</h1>
                        </a></div>
                </div>
                <div class="RegistrationLink"> Vous n'avez pas de compte ?<a href="{{ url('reg') }}">Sign Up</a>
                </div>
            @endif
        </form>
    </div>

</body>

</html>
