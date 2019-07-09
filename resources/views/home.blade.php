@extends('layout')

@section('content')
<main role="main" class="container">
    <section>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($carousel as $c)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach 
            </ol>
            
            <div class="carousel-inner">
                @foreach($carousel as $c)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ route('uploaded', ['filename' => $c->image_desktop]) }}" class="d-none d-sm-block" alt="{{$c->title}}" style="width: 100%;">
                    <img src="{{ route('uploaded', ['filename' => $c->image_mobile]) }}" class="d-block d-sm-none" alt="{{$c->title}}" style="width: 100%;">
                    <div class="carousel-caption">
                        <h5>{{$c->title}}</h5>
                        <p>{{$c->description}}</p>
                    </div>
                </div>
                @endforeach 
            </div>
            
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
</main>
@endsection