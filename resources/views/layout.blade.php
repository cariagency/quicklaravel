<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @section('metas')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @show

        <title>
            @section('title')
            {{ config('app.name', 'Maronaz') }}
            @endsection
        </title>

        @section('stylesheets')
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ assetv('css/main.css') }}">
        @show
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">Maronaz</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main-menu">
                <ul class="navbar-nav mr-auto"></ul>

                <ul class="navbar-nav">
                    @section('user-menu')
                    @if(isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" href="#">Utilisateurs</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        @if(user())
                        <a class="nav-link" href="#">Déconnexion</a>
                        @else
                        <a class="nav-link" href="#">Connexion</a>
                        @endif
                    </li>
                    @show
                </ul>
            </div>
        </nav>

        @yield('content')

        @section('javascripts')
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="{{ assetv('js/main.js') }}"></script>
        @show
    </body>
</html>