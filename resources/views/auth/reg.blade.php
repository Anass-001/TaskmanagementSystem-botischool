<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Registration
    </title>
    <link rel="stylesheet" href="{{ url('public/css/RegStyle.css') }}">

</head>

<body>


    <div class="wrapper">
        @include('_message')

        <form action="{{ url('reg_post') }}" method="post">


            {{ csrf_field() }}
            <h1>Registration</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" required name="name" value="{{ old('name') }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 18 18">
                    <title>user</title>
                    <g fill="#ffffff" class="nc-icon-wrapper">
                        <circle cx="9" cy="4.5" r="3.5" fill="#ffffff" data-color="color-2"></circle>
                        <path
                            d="M9,9c-2.764,0-5.274,1.636-6.395,4.167-.257,.58-.254,1.245,.008,1.825,.268,.591,.777,1.043,1.399,1.239,1.618,.51,3.296,.769,4.987,.769s3.369-.259,4.987-.769c.622-.196,1.132-.648,1.399-1.239,.262-.58,.265-1.245,.008-1.825-1.121-2.531-3.631-4.167-6.395-4.167Z"
                            fill="#ffffff"></path>
                    </g>
                </svg>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Email" required name="email">
                <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 18 18">
                    <title>user</title>
                    <g fill="#ffffff" class="nc-icon-wrapper">
                        <circle cx="9" cy="4.5" r="3.5" fill="#ffffff" data-color="color-2"></circle>
                        <path
                            d="M9,9c-2.764,0-5.274,1.636-6.395,4.167-.257,.58-.254,1.245,.008,1.825,.268,.591,.777,1.043,1.399,1.239,1.618,.51,3.296,.769,4.987,.769s3.369-.259,4.987-.769c.622-.196,1.132-.648,1.399-1.239,.262-.58,.265-1.245,.008-1.825-1.121-2.531-3.631-4.167-6.395-4.167Z"
                            fill="#ffffff"></path>
                    </g>
                </svg>
            </div>


            <div class="input-box">
                <input type="password" placeholder="password" required name="password" value="{{ old('name') }}">
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
                <input type="password" placeholder=" Comfirm Password" required name="comfirm_password">
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

                <select name="is_role" required>

                    <option value="" disabled selected hidden>Role</option>
                    <option {{ old('is_role' == '0' ? 'selected' : '') }}value="0">User</option>
                    <option {{ old('is_role' == '1' ? 'selected' : '') }} value="1">Manager</option>
                    <option {{ old('is_role' == '2' ? 'selected' : '') }} value="2">Admin</option>
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24">
                    <title>face recognition</title>
                    <g stroke-linejoin="miter" fill="#ffffff" stroke-linecap="butt" class="nc-icon-wrapper">
                        <polyline points="2 6 2 2 6 2" fill="none" stroke="#ffffff" stroke-linecap="square"
                            stroke-miterlimit="10" stroke-width="2" data-color="color-2"></polyline>
                        <polyline points="22 6 22 2 18 2" fill="none" stroke="#ffffff" stroke-linecap="square"
                            stroke-miterlimit="10" stroke-width="2" data-color="color-2"></polyline>
                        <polyline points="2 18 2 22 6 22" fill="none" stroke="#ffffff" stroke-linecap="square"
                            stroke-miterlimit="10" stroke-width="2" data-color="color-2"></polyline>
                        <polyline points="22 18 22 22 18 22" fill="none" stroke="#ffffff" stroke-linecap="square"
                            stroke-miterlimit="10" stroke-width="2" data-color="color-2"></polyline>
                        <path
                            d="M18,19l-2.469-.617a2,2,0,0,1-1.515-1.95l0-1.027A6.687,6.687,0,0,0,17,10V9A5,5,0,0,0,7,9v1a6.687,6.687,0,0,0,2.986,5.406l0,1.027a2,2,0,0,1-1.515,1.95L6,19"
                            fill="none" stroke="#ffffff" stroke-linecap="square" stroke-miterlimit="10"
                            stroke-width="2"></path>
                    </g>
                </svg>
            </div>

            <div class="btn">
                <input type="submit">
            </div>

        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sélection du formulaire et des champs de saisie
            const form = document.querySelector('form');
            const usernameInput = document.querySelector('input[type="text"]');
            const passwordInput = document.querySelector('input[type="password"]');
            const rememberCheckbox = document.querySelector('input[type="checkbox"]');

            // Écouter l'événement de soumission du formulaire
            // Empêcher le rechargement de la page

            // Récupérer les valeurs saisies
            const username = usernameInput.value;
            const password = passwordInput.value;
            const rememberMe = rememberCheckbox.checked;

            // Validation des champs (vous pouvez ajouter des validations supplémentaires ici)

            // Envoi des données au serveur (simulé ici)
            // Remplacez cette partie par votre logique de connexion réelle
            console.log("Username:", username);
            console.log("Password:", password);
            console.log("Remember me:", rememberMe);

            // Réinitialiser le formulaire si nécessaire
            form.reset();
        });
    </script>
</body>

</html>
