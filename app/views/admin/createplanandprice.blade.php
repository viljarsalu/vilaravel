@foreach($errors->all() as $error)
<p class="text-danger">{{ $error }}</p>
@endforeach

{{ Form::open(array('url'=>'admin/createplanandprice', 'role'=>'form', 'id'=>'createplanandprice')) }}
    <label for="public">Make public</label>
    <input type="checkbox" name="public" id="public" />
    
    <fieldset>
        <legend>Enter pan and price title</legend>
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.title'),'id'=>'title')) }}
    </fieldset>

    <fieldset>
        <legend>Enter pan and price description</legend>
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.description'),'id'=>'description')) }}
    </fieldset>

    <fieldset>
        <legend>Enter price</legend>
        {{ Form::label('price', 'Price') }}
        {{ Form::text('price', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.price'),'id'=>'price')) }}
    </fieldset>

    <fieldset>
        <legend>Enter date start and date end</legend>
        {{ Form::label('start_date', 'Start date') }}
        {{ Form::text('start_date', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.start_date'),'id'=>'start_date')) }}
        <hr />
        {{ Form::label('end_date', 'End date') }}
        {{ Form::text('end_date', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.end_date'),'id'=>'end_date')) }}
    </fieldset>

    {{ Form::submit(Lang::get('text.save'), array('class'=>'btn btn-large btn-primary')) }}

{{ Form::close() }}