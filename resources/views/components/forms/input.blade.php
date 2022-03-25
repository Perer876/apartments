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
        <input 
            class="form-control @if (old('_token') != null) @error($name) is-invalid @else is-valid @enderror @endif" 
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
        @error($name)
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
            {{ $message }}
        </div>
        @enderror
    @if ($attributes['horizontal-form'])
    </div>
    @endif
</div>