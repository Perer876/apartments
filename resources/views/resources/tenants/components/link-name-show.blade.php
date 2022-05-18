@can('view', $tenant)
    @if( $tenant->trashed())
        <i class="bi bi-archive me-1"></i>
        <span>{{ $tenant->name }}</span>
    @else
        <i class="bi bi-person me-1"></i>
        <a 
            href="{{route('tenants.show', [$tenant])}}" 
            class="link-secondary text-underline-hover">{{ $tenant->name }}
        </a>
    @endif
@else
    {{ $tenant->name }}
@endcan