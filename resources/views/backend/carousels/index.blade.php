@extends('backend.layout')

@section('content')
<div class="container" id="backend-carousels-index">
    <div class="float-right">
        <a href="{{ route('carousels.create') }}" class="btn btn-primary">Ajouter un slide</a>
    </div>

    <h1 style="font-size: 2.2rem">Carousel</h1><hr/>

    <div class="row">
        @foreach($carousels as $k => $c)
        <div class="col-md-4 col-lg-3" style="margin-bottom: 20px">
            <div class="card">
                <img class="card-img-top" src="{{ route('uploaded', ['filename' => $c->image_front]) }}" alt="{{ $c->title }}"/>
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">{{ $c->title }}</h5>
                    <p class="card-text">{{ $c->description }}</p>
                </div>

                <div class="controls text-center">
                    @if($k > 0)
                    <a href="{{ route('carousels.sort', ['carousel' => $c->id, 'sort' => 'up']) }}" class="btn btn-light btn-sm left" title="Placer en position {{ $k }}">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    @endif

                    <div class="center">
                        <button data-action="{{ route('carousels.destroy', ['carousel' => $c->id]) }}" class="btn btn-danger btn-sm" title="Supprimer">
                            <i class="fa fa-trash"></i>
                        </button>
                        <a href="{{ route('carousels.edit', ['carousel' => $c->id]) }}" class="btn btn-primary btn-sm" title="Modifier">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </div>

                    @if($k < $carousels->count() - 1)
                    <a href="{{ route('carousels.sort', ['carousel' => $c->id, 'sort' => 'down']) }}" class="btn btn-light btn-sm right" title="Placer en position {{ $k + 2 }}">
                        <i class="fa fa-arrow-right"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{ Form::open(['method' => 'delete', 'id' => 'delete-form', 'data-confirm' => 'Voulez-vous vraiment supprimer ce slide ?']) }}{{ Form::close() }}
@endsection