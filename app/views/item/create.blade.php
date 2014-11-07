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
        @for ($i = 0; $i < count(Config::get('pagesettings.types')); $i++ )
            <option value="{{ Config::get('pagesettings.types')[$i] }}">{{ Lang::get('text.' . Config::get('pagesettings.types')[$i]) }}</option>
        @endfor
        </select>

        <br>
        <label for="label">Label</label>
        <select name="label" id="label">
        @foreach( $label as $key=>$value )
            <option value="{{ $value->id }}">{{ $value->title }}</option>
        @endforeach
        </select>
    </fieldset>

    <fieldset>
        <legend>Plan and Price</legend>
        <ul class="list-inline">
            @foreach( $plansPrices as $key=>$value )
                <li>
                    {{ Form::label('plan'.$value->id, $value->title) }}
                    {{ Form::radio('plan_and_price', $value->id); }}
                </li>
            @endforeach
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
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.description'),'id'=>'description')) }}
    </fieldset>

    {{ Form::submit(Lang::get('text.send_reminder'), array('class'=>'btn btn-large btn-primary')) }}

{{ Form::close() }}