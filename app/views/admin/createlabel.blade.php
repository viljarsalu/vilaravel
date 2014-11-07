@foreach($errors->all() as $error)
<p class="text-danger">{{ $error }}</p>
@endforeach

{{ Form::open(array('url'=>'admin/createlabel', 'role'=>'form', 'id'=>'createlabel')) }}
    <label for="public">Make public</label>
    <input type="checkbox" name="public" id="public" />
    
    <fieldset>
        <legend>Enter label</legend>
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.title'),'id'=>'title')) }}
    </fieldset>

    {{ Form::submit(Lang::get('text.save'), array('class'=>'btn btn-large btn-primary')) }}

{{ Form::close() }}