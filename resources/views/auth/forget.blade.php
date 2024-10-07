<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        LoginPage
    </title>
    <link rel="stylesheet" href="{{ url('public/css/RegStyle.css') }}">

</head>

<body>

    <div class="wrapper">
        @include('_message')
        <form action="{{ url('forget_post') }}" method="post">
            {{ csrf_field() }}
            <h1>Mot de passe oublié ?</h1>
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


            <div class="btn">
                <input type="submit">

            </div>

        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {


            // Écouter l'événement de soumission du formulaire
            form.addEventListener("submit", function(event) {
                event.preventDefault(); // Empêcher le rechargement de la page
                // Réinitialiser le formulaire si nécessaire

            });
        });
    </script>
</body>

</html>
