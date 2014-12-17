<ul class="list-inline">
@foreach ($assets as $key => $asset)
    <li><img src="{{ $asset->source }}"/><br /><input type="radio" value="{{ $asset->id }}" name="item_id" /></li>
@endforeach
</ul>