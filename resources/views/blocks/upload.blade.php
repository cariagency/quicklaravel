<div class="upload-block">
    {!! BootForm::text($name, $label) !!}

    <div class="preview hidden">
        <button type="button" class="btn btn-sm btn-danger btn-delete">
            <i class="fa fa-times"></i>
        </button>
        <img/>
    </div>

    <a href="#" class="btn btn-primary btn-sm btn-add btn-block hidden">
        <span>Ajouter une image</span>
        <i class="fa fa-spinner fa-spin fa-fw"></i>
        <input type="file" name="file">
    </a>

    @if(isset($comment))
    <small>{!! $comment !!}</small>
    @endif
</div>