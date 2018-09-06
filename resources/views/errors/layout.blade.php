@extends('layout')

@section('content')
<main role="main" class="container">
    <div class="row">
        <div class="col">
            <div class="alert alert-danger mt-5 mt-xs-3" role="alert">
                <h4 class="alert-heading">Oups!</h4>
                <p>@yield('message')</p>
                @section('link')
                <p class="mb-0">
                    <a href="{{ route('home') }}" class="alert-link">Revenir à l'accueil</a>
                </p>
                @show
            </div>

            @if(config('app.debug') && isset($exception))
            @if(isset($exception->xdebug_message))
            <table>{!! $exception->xdebug_message !!}</table>
            @else
            <pre>{{ $exception }}</pre>
            @endif
            @endif
        </div>
    </div>
</main>
@endsection