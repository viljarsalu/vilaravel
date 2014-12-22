<ul class="list-inline">
@foreach ($assets as $key => $asset)
    <li>
    	<img src="{{ $asset->source }}"/><br />
    	<!-- <input type="radio" value="{{ $asset->id }}" name="asset_id" /> -->
    	{{ Form::radio('asset_id', $asset->id); }}
    </li>
@endforeach
</ul>