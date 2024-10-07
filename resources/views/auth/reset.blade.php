<!DOCTYPE html>
<html lang="en">

<head>
    <title>LoginPage</title>
    <link rel="stylesheet" href="{{ url('public/css/RegStyle.css') }}">
</head>

<body>
    <div class="wrapper">
        @include('_message')
        <form action="{{ url('reset_post/' . $token) }}" method="post">
            {{ csrf_field() }}
            <h1>Réinitialiser votre mot de passe</h1>
            <div class="input-box">
                <input type="password" placeholder="Password" required name="password">
                <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 18 18">
                    <title>lock</title>
                    <g fill="#ffffff" class="nc-icon-wrapper">
                        <path
                            d="M12.25,9c-.414,0-.75-.336-.75-.75v-3.25c0-1.378-1.122-2.5-2.5-2.5s-2.5,1.122-2.5,2.5v3.25c0,.414-.336,.75-.75,.75s-.75-.336-.75-.75v-3.25c0-2.206,1.794-4,4-4s4,1.794,4,4v3.25c0,.414-.336,.75-.75,.75Z"
                            fill="#ffffff" data-color="color-2"></path>
                        <path
                            d="M12.75,7.5H5.25c-1.517,0-2.75,1.233-2.75,2.75v4c0,1.517,1.233,2.75,2.75,2.75h7.5c1.517,0,2.75-1.233,2.75-2.75v-4c0-1.517-1.233-2.75-2.75-2.75Zm-3,5.25c0,.414-.336,.75-.75,.75s-.75-.336-.75-.75v-1c0-.414,.336-.75,.75-.75s.75,.336,.75,.75v1Z"
                            fill="#ffffff"></path>
                    </g>
                </svg>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Confirm Password" required name="password_confirmation">
                <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 18 18">
                    <title>lock</title>
                    <g fill="#ffffff" class="nc-icon-wrapper">
                        <path
                            d="M12.25,9c-.414,0-.75-.336-.75-.75v-3.25c0-1.378-1.122-2.5-2.5-2.5s-2.5,1.122-2.5,2.5v3.25c0,.414-.336,.75-.75,.75s-.75-.336-.75-.75v-3.25c0-2.206,1.794-4,4-4s4,1.794,4,4v3.25c0,.414-.336,.75-.75,.75Z"
                            fill="#ffffff" data-color="color-2"></path>
                        <path
                            d="M12.75,7.5H5.25c-1.517,0-2.75,1.233-2.75,2.75v4c0,1.517,1.233,2.75,2.75,2.75h7.5c1.517,0,2.75-1.233,2.75-2.75v-4c0-1.517-1.233-2.75-2.75-2.75Zm-3,5.25c0,.414-.336,.75-.75,.75s-.75-.336-.75-.75v-1c0-.414,.336-.75,.75-.75s.75,.336,.75,.75v1Z"
                            fill="#ffffff"></path>
                    </g>
                </svg>
            </div>

            <div class="btn">
                <input type="submit" name="Login">
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sélection du formulaire et des champs de saisie
            const form = document.querySelector('form');
            const passwordInput = document.querySelector('input[name="password"]');
            const passwordConfirmationInput = document.querySelector('input[name="password_confirmation"]');

            // Envoi des données au serveur (simulé ici)
            // Remplacez cette partie par votre logique de connexion réelle
            console.log("Password:", passwordInput.value);
            console.log("Password Confirmation:", passwordConfirmationInput.value);

            // Réinitialiser le formulaire si nécessaire
            form.reset();
        });
    </script>
</body>

</html>
