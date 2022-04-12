<li class="submenu-item {{'/' . Request::path() == $attributes['href'] ? 'active' : null}}">
    <a href="{{$attributes['href']}}">{{ $slot }}</a>
</li>