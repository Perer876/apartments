<nav aria-label="breadcrumb">
    <ol class="breadcrumb @if($attributes['align']){{' breadcrumb-' . $attributes['align']}}@endif">
        {{ $slot }}
    </ol>
</nav>