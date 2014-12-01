@foreach($errors->all() as $error)
<p class="text-danger">{{ $error }}</p>
@endforeach

{{ Form::open(array('url'=>'item/create', 'role'=>'form', 'id'=>'create')) }}
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
                    <div style="border:1px solid #c8c8c8; padding:10px;">
                        <h3>{{ $value->title }}</h3>
                        <p>{{ $value->description }}</p>
                        {{ Form::label('plan_and_price', $value->title) }}
                        {{ Form::radio('plan_and_price', $value->id); }}
                    </div>
                </li>
            @endforeach
        </ul>
    </fieldset>

    <fieldset>
        <legend>Item Content</legend>
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.title'),'id'=>'title')) }}
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.description'),'id'=>'description')) }}
    </fieldset>

<!-- existing address -->
    <div class="row">
        <div class="col-md-12">
            <h3>Choose address</h3>
            <ul class="list-inline">
            @foreach( $existing_address as $key=>$value )
                <li>
                    <div style="border:1px solid #c8c8c8; padding:10px;">
                        
                        <p>{{ $value->street_address }}</p>
                        {{ Form::radio('existing_address_id', $value->id); }}
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
<!-- / existing address -->

    @include('address.create')
    
    {{ Form::submit(Lang::get('text.save'), array('class'=>'btn btn-large btn-primary')) }}

{{ Form::close() }}

