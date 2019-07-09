@extends('layout')

@section('content')
<main role="main" class="container" id="users-index">
    <div class="row">
        <div class="col">
            <h2>
                @if($carousel->id)
                Modifer le slide #{{ $carousel->order }}
                @else
                Ajouter un slide
                @endif
            </h2>  
        </div>
    </div>

    <div class="row">
        <div class="col">
            {!! BootForm::open(['model' => $carousel, 'files'=>true, 'store' => 'carousels.store', 'update' => 'carousels.update', 'id' => 'carousel-form', 'autocomplete' => 'off']) !!}

            {!! BootForm::text('title', 'Titre') !!}

            {!! BootForm::text('description', 'Description') !!}

            <div class="row">
                <div class="col-12 col-md-4">
                    @include('blocks.upload', [
                    'name' => 'image_desktop', 
                    'label' => 'Image desktop',
                    'value' => $carousel->image_desktop
                    ])
                </div>
                <div class="col-12 col-md-4">
                    @include('blocks.upload', [
                    'name' => 'image_mobile', 
                    'label' => 'Image mobile',
                    'value' => $carousel->image_mobile
                    ])
                </div>
                <div class="col-12 col-md-4">
                    @include('blocks.upload', [
                    'name' => 'image_front', 
                    'label' => 'Aperçu',
                    'value' => $carousel->image_front
                    ])
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <a href="{{ route('carousels.index') }}" class="btn btn-light">@lang("Cancel")</a>
                </div>
                <div class="col-6 text-right">
                    <input class="btn btn-primary" type="submit" value="Enregistrer"/>
                </div>
            </div>

            {!! BootForm::close() !!}     
        </div>
    </div>
</main>
@endsection
