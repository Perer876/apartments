@php
$size = $attributes['size'] ?? ($attributes['horizontal-form'] ? 8 : 12)
@endphp
<div class="form-group {{ $attributes['horizontal-form'] ? 'row' : 'col-md-'.$size}}">
    <label
        @if ($attributes['horizontal-form'])
            class="col-md-{{ 12 - $size }} col-form-label" 
        @endif
        for="{{ $name }}"
    >
        {{ $label }}
    </label>

    @if ($attributes['horizontal-form'])
        <div class="col-md-{{$size}}">
    @endif

    @if (isset($addonsLeft) or isset($addonsRight))
        <div class="input-group">
    @endif

    @if (isset($addonsLeft))
        {{ $addonsLeft }}
    @endif

    <input 
        class="form-control{{ $attributes['plaintext'] ? '-plaintext' : null }} @if (old('_token') != null) @error($name) is-invalid @else is-valid @enderror @endif" 
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        placeholder="{{ $attributes['placeholder'] }}" 
        @if (strlen(old($name)) > 0)
            value="{{ old($name) }}"
        @elseif ($attributes['object'])
            value="{{$attributes['object'][$name]}}"
        @endif
        @if ($attributes['readonly'])
            readonly
        @endif
    >

    @if (isset($addonsRight))
        {{ $addonsRight }}
    @endif

    @error($name)
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
            {{ $message }}
        </div>
    @enderror

    @if (isset($addonsLeft) or isset($addonsRight))
        </div>
    @endif

    @if ($attributes['horizontal-form'])
        </div>
    @endif
</div>