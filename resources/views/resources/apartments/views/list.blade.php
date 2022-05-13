<div class="list-group">
    @foreach ($apartments as $apartment)
        <a href="{{$apartment->href}}" class="list-group-item list-group-item-action">
            @include('resources.apartments.components.list-item-show', [
                'hide' => isset($hide) ? $hide : [], 
                'apartment' => $apartment,
            ])
        </a>
    @endforeach
</div>