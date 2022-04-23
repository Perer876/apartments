<span class="input-group-text{{$attributes['datepicker'] ? ' d-block' : null }}">
    @if ($attributes['icon'])
        <span class="{{$attributes['icon']}}"></span>
    @endif
    {{ $slot }}
</span>