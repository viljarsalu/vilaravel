<ul class="list-inline">
    @foreach( $address_list as $key=>$value )
    <li>
        <div style="border:1px solid #c8c8c8; padding:10px;">
            <p>{{ $value->street_address }}</p>
            {{ Form::radio('existing_address_id', $value->id); }}
        </div>
    </li>
    @endforeach
</ul>