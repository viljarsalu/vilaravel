<div class="row">
    <div class="col-md-12">
        {{ Form::open(array('url'=>'hello/upload', 'role'=>'form', 'id'=>'upload', 'files'=>'true')) }}
            {{ Form::label('title', 'Title') }}
            {{-- Form::text('title', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.title'),'id'=>'title')) --}}

            {{ Form::file('picture') }}
            {{ Form::submit(Lang::get('text.save'), array('class'=>'btn btn-large btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>