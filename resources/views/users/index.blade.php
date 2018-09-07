@extends('layout')

@section('content')
<main role="main" class="container" id="users-index">
    <div class="row align-items-center">
        <div class="col col-md-10">
            <h1>@lang("Users")</h1>
        </div>
        <div class="col col-md-2 text-right">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang("Add an user")</a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" class="min">#</th>
                        <th scope="col">@lang("Name")</th>
                        <th scope="col">@lang("Email")</th>
                        <th scope="col">@lang("Type")</th>
                        <th scope="col" class="min"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->type) }}</td>
                        <td class="text-right actions">
                            @if(user()->id !== $user->id)
                            <button type="submit" class="btn btn-danger btn-sm" title="@lang('Delete')" data-action="{{ route('users.destroy', ['user' => $user->id]) }}"><i class="fa fa-trash"></i></button>
                            @endif
                            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-primary btn-sm" title="@lang('Edit')"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ Form::open(['method' => 'delete', 'id' => 'delete-form', 'data-confirm' => __('Do you really want to delete this user?')]) }}{{ Form::close() }}
</main>
@endsection