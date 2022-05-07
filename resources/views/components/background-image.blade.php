@push('stylesheets')
    <style>
        #{{$attributes['id']}} {
            background-image: url("{{$attributes['url']}}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
    </style>
@endpush
<div id="{{$attributes['id']}}" class="{{$attributes['class']}}">
    {{ $slot }}
</div>