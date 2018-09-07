@extends('layout')

@section('content')
<main role="main" class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        @lang(session('status'))
    </div>
    @endif

    <div class="starter-template">
        <div class="row justify-content-center">
            <div class="col col-md-10">
                <h1>@lang("Welcome to QuickLaravel")</h1>

                <p class="lead">
                    @lang("Start quickly a Laravel 5 and Bootstrap 4 project with application structure, starter layout, authentication and user management out of the box")
                </p>
            </div>
        </div>
    </div>
</main>
@endsection