<!DOCTYPE html>
<html>

<head>
    <style>
        .button {
            background-color: #3490dc;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <p>Hi {{ $user->name }}</p>

    <p>Vous avez oublié le mot de passe ? Pas de souci, ça arrive.</p>

    <p>
        <a href="{{ url('reset/' . $user->remember_token) }}" class="button">Réinitialiser votre mot de passe</a>
    </p>

    <p>Merci !!</p>

    <p>{{ config('app.name') }}</p>
</body>

</html>
