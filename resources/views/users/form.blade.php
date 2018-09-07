@extends('layout')

@php($profile = (\Request::route()->getName() === 'users.profile'))
@php($me = (user()->id === $user->id))

@section('content')
<main role="main" class="container" id="users-index">
    <div class="row">
        <div class="col">
            <h2>
                @if($profile)
                @lang("Profile")
                @elseif($user->id)
                @lang("Edit :user", ['user' => $user->name])
                @else
                @lang('New user')
                @endif
            </h2>  
        </div>
    </div>

    <div class="row">
        <div class="col col-md-4">
            {!! BootForm::open($form_options) !!}

            @if(isAdmin() && !$me)
            {!! BootForm::radios('type', 'Type', ['user' => __('User'), 'admin' => __('Administrator')], null, true) !!}
            @endif

            {!! BootForm::text('name', __('Name')) !!}

            {!! BootForm::text('email', __('Email')) !!}

            @if($me)
            {!! BootForm::password('password', __('Password'), ['autocomplete' => 'off']) !!}

            {!! BootForm::password('password_confirmation', __('Confirm password'), ['autocomplete' => 'off']) !!}
            @endif

            <div class="form-group">
                <div>
                    <a href="{{ route($profile ? 'home' : 'users.index') }}" class="btn btn-light">@lang("Cancel")</a>
                    <input class="btn btn-primary" type="submit">
                </div>
            </div>

            {!! BootForm::close() !!}     
        </div>
    </div>
</main>
@endsection
