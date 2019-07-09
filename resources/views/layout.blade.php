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
            {{ config('app.name') }}
            @show
        </title>

        @section('stylesheets')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.18.0/css/jquery.fileupload.min.css" />
        <link rel="stylesheet" href="{{ assetv('css/main.css') }}">
        @show
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main-menu">
                @include('menu')
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col">
                    @foreach(['danger', 'warning', 'info', 'success'] as $status)
                    @if (session($status))
                    <div class="alert alert-{{ $status }} alert-dismissible fade show" role="alert">
                        @lang(session($status))
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        @yield('content')

        <div id="scrollers">
            <a href="#top" class="btn btn-dark btn-sm"><i class="fa fa-arrow-up"></i></a>
            <br/>
            <a href="#bottom" class="btn btn-dark btn-sm"><i class="fa fa-arrow-down"></i></a>
        </div>

        @section('javascripts')
        @routes
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.18.0/js/vendor/jquery.ui.widget.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.18.0/js/jquery.fileupload.min.js"></script>
        <script src="{{ assetv('js/upload-block.js') }}"></script>
        <script src="{{ assetv('js/main.js') }}"></script>
        @show
    </body>
</html>