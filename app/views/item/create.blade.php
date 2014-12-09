<style type="text/css">
    fieldset {
        border:1px solid #c8c8c8; padding:10px; margin-bottom: 20px;
    }
    legend {
        border:1px solid #c8c8c8; padding:5px;
    }
</style>

@foreach($errors->all() as $error)
<p class="text-danger">{{ $error }}</p>
@endforeach

{{ Form::open(array('url'=>'item/create', 'role'=>'form', 'id'=>'create', 'files'=>'true')) }}
    
    <fieldset>
        <legend>Step #1</legend>
        <p>{{ Form::label('public', 'Make public') }}
        {{ Form::checkbox('public', null, true, array('id'=>'public')) }}</p>

        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.title'),'id'=>'title')) }}
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>Lang::get('text.description'),'id'=>'description')) }}
    </fieldset>

    
    <fieldset>
        <legend>Step #2</legend>
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
        <legend>Step #3</legend>
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
        <legend>Step #4</legend>

        <h3 class="text-center">choose from gallery</h3>
        <ul class="list-inline">
        @foreach ($assets as $key => $asset)
            <li><img src="{{ $asset->source }}"/><br /><input type="radio" value="{{ $asset->id }}" name="item_id" /></li>
        @endforeach
        </ul>
        <h3 class="text-center"> OR <br> add new</h3>
        @include('item.upload.browseFile')
    </fieldset>

<!-- existing address -->
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend>Step #5</legend>

                <h3 class="text-center">Choose address</h3>
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
                <h3 class="text-center"> or<br />Add New Address</h3>

                @include('address.create')

            </fieldset>
        </div>
    </div>
<!-- / existing address -->
    
    
    
    {{ Form::submit(Lang::get('text.save'), array('class'=>'btn btn-large btn-primary')) }}

{{ Form::close() }}

