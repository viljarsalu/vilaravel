@foreach($errors->all() as $error)
<p class="text-danger">{{ $error }}</p>
@endforeach

{{ Form::open(array('url'=>'item/create', 'role'=>'form', 'id'=>'remind')) }}
    <label for="public">Make public</label>
    <input type="checkbox" name="public" id="public" />
    <fieldset>
        <legend>Choose Type and Label</legend>
        <label for="type">Type</label>
        <select name="type" id="type">
            <option value="type_1">Type 1</option>
            <option value="type_2">Type 2</option>
            <option value="type_3">Type 3</option>
        </select>

        <br>
        <label for="label">Label</label>
        <select name="label" id="label">
            <option value="label_1">Label 1</option>
            <option value="label_2">Label 2</option>
            <option value=".abel_3">Label 3</option>
        </select>
    </fieldset>

    <fieldset>
        <legend>Plan and Price</legend>
        <ul class="list-inline">
            <li>
                {{ Form::label('plan1', 'plan a') }}
                {{ Form::radio('plan_and_price', 'plan1'); }}
            </li>
            <li>
                {{ Form::label('plan2', 'plan b') }}
                {{ Form::radio('plan_and_price', 'plan2'); }}
            </li>
            <li>
                {{ Form::label('plan3', 'plan c') }}
                {{ Form::radio('plan_and_price', 'plan3'); }}
            </li>
        </ul>
    </fieldset>

    <fieldset>
        <legend>Location</legend>
        {{ Form::label('address', 'Address') }}
        {{ Form::text('address', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.address'),'id'=>'address')) }}
    </fieldset>

    <fieldset>
        <legend>Item Content</legend>
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.title'),'id'=>'title')) }}
        {{ Form::label('content', 'Content') }}
        {{ Form::textarea('content', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.content'),'id'=>'content')) }}
    </fieldset>

    {{ Form::submit(Lang::get('text.send_reminder'), array('class'=>'btn btn-large btn-primary')) }}

{{ Form::close() }}