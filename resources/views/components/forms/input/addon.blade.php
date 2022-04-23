<span class="input-group-text">
    @if ($attributes['icon'])
        <span class="{{$attributes['icon']}}"></span>
    @endif
    {{ $slot }}
</span>