@extends('layout')

@section('content')
<main role="main" class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        @lang(session('status'))
    </div>
    @endif

    <div class="starter-template">
        <h1>Welcome to QuickLaravel</h1>

        <p class="lead">
            Start quickly a Laravel 5 and Bootstrap 4 project with application structure, <br/>
            starter layout, authentication and user management out of the box
        </p>
    </div>
</main>
@endsection