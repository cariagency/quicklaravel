@php($page_title = 'Utilisateur')

@extends('layout')

@section('content')
<main role="main" class="container" id="users-index">
    <div class="row">
        <div class="col">
            <h2>
                @if($user->id)
                @lang("Modifier :user", ['user' => $user->name])
                @else
                @lang('Créer un nouvel utilisateur')
                @endif
            </h2>  
        </div>
    </div>

    <div class="row">
        <div class="col col-md-4">
            {!! BootForm::open(['model' => $user, 'store' => 'users.store', 'update' => 'users.update', 'id' => 'user-form', 'autocomplete' => 'off']) !!}

            @if(isAdmin())
            {!! BootForm::radios('type', 'Type', ['user' => __('User'), 'admin' => __('Administrator')], null, true) !!}
            @endif

            {!! BootForm::text('name', __('Name')) !!}

            {!! BootForm::text('email', __('Email')) !!}

            @if($user->id === user()->id)
                {!! BootForm::password('password', __('Password')) !!}

                {!! BootForm::password('password_confirmation', __('Confirm password')) !!}
            @endif

            <div class="form-group">
                <div>
                    <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                    <input class="btn btn-primary" type="submit">
                </div>
            </div>

            {!! BootForm::close() !!}     
        </div>
    </div>
</main>
@endsection
