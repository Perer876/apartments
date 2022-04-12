<li class="sidebar-item {{ isset($submenu) ? 'has-sub' : null }}{{ Request::segment(1) == $route ? ' active' : null }}">
    <a href="{{ $href }}" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $slot }}</span>
    </a>
    @isset($submenu)
    <ul class="submenu{{ Request::segment(1) == $route ? ' active' : null }}">
        {{ $submenu }}
    </ul>
    @endif
</li>