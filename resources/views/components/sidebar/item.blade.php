<li 
    @class([
        'sidebar-item',
        'has-sub' => isset($submenu),
        'active' => Request::segment(1) == $route,
    ])
>
    <a href="{{ $href }}" class='sidebar-link' {{$attributes}} >
        <i class="{{ $icon }}"></i>
        <span>{{ $slot }}</span>
    </a>
    @isset($submenu)
        <ul
            @class([
                'submenu',
                'active' => Request::segment(1) == $route,
            ])
        >
            {{ $submenu }}
        </ul>
    @endif
</li>