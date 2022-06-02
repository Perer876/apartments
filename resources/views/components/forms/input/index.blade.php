@php
    $size = $attributes['size'] ?? ($attributes['horizontal-form'] ? 8 : 12);
    $name = $attributes['name'] ?? $attributes->whereStartsWith('wire:model')->first();
    /* if($name != 'name') { dd($errors->has($name), $name); }; */
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

    @isset($addonsLeft)
        {{ $addonsLeft }}
    @endisset

    <input
        @class([
            $attributes['class'] ?? 'form-control',
            $errors->has($name) ? 'is-invalid' : 'is-valid' => old('_token') || $attributes['validate']
        ])
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        @if (strlen(old($name)) > 0)
            value="{{ old($name) }}"
        @elseif ($attributes['object'])
            value="{{$attributes['object'][$name]}}"
        @elseif ($attributes->has('value'))
            value="{{$attributes['value']}}"
        @endif
        {{ $attributes->filter(
            fn ($value, $key) => $key == 'placeholder' || $key == 'step' || $key == 'autocomplete'
            ) 
        }}
        {{ $attributes->whereStartsWith('wire:model') }}
        {{ $attributes->whereStartsWith('x-') }}
        @if ($attributes->has('readonly'))
            readonly 
        @endif
        @isset($datepicker)
            data-provide="datepicker"                      
            onchange="this.dispatchEvent(new InputEvent('input'))"
            {{$datepicker->attributes}}
        @endisset
    >

    @isset($addonsRight)
        {{ $addonsRight }}
    @endisset

    @error($name)
        <div class="invalid-feedback text-end">
            <i class="bx bx-radio-circle"></i>
            <span class="badge bg-light-danger text-wrap">{{ $message }}</span>
        </div>
    @enderror

    @if (isset($addonsLeft) or isset($addonsRight))
        </div>
    @endif

    @if ($attributes->has('horizontal-form'))
        </div>
    @endif
</div>

@isset($datepicker)
    @push('stylesheets')
        @once
            <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
        @endonce
    @endpush
    @push('scripts')
        @once
            <script src="{{ asset('assets\vendors\jquery\jquery.min.js')}}"></script>
            <script src="{{ asset('assets\vendors\bootstrap-datepicker\bootstrap-datepicker.min.js')}}"></script>
        @endonce
    @endpush
@endisset
