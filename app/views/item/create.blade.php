{{ Form::open(array('url'=>'items/create', 'role'=>'form', 'id'=>'remind')) }}

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