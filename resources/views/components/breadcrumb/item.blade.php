@if ($attributes['href'])
    <li class="breadcrumb-item"><a href="{{$attributes['href']}}">{{ $slot }}</a></li>
@else
    <li class="breadcrumb-item active" aria-current="page">{{ $slot }}</li>
@endif