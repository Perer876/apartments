<li
class="sidebar-item {{ Request::is($route) ? 'active' : '' }}">
<a href="{{ $href }}" class='sidebar-link'>
    <i class="bi bi-{{ $icon }}-fill"></i>
    <span>{{ $slot }}</span>
</a>
</li>