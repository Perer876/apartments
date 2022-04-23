@php
    $size = $attributes['size'] ?? ($attributes['horizontal-form'] ? 8 : 12);
    $name = $attributes->whereStartsWith('wire:model')->first() ?? $attributes['name'];

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

    @if (isset($addonsLeft) or isset($addonsRight) or $attributes['datepicker'])
        <div 
            class="input-group{{$attributes['datepicker'] ? ' date' : null}}"
            @if ($attributes['datepicker'])
                id="{{$attributes['datepicker']}}"
            @endif
        >
    @endif

    @if (isset($addonsLeft))
        {{ $addonsLeft }}
    @endif

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
        @if ($attributes->has('readonly'))
            readonly 
        @endif
        @if($attributes['datepicker'])
            data-provide="datepicker"                      
            onchange="this.dispatchEvent(new InputEvent('input'))"
            @if(isset($datepicker))
                {{$datepicker->attributes}}
            @endif 
        @endif
    >

    @if($attributes['datepicker'])
        <span class="input-group-append" role="button">
    @endif
    @if (isset($addonsRight))
        {{ $addonsRight }}
    @endif
    @if($attributes['datepicker'])
        </span>
    @endif

    @error($name)
        <div class="invalid-feedback text-end">
            <i class="bx bx-radio-circle"></i>
            <span class="badge bg-light-danger text-wrap">{{ $message }}</span>
        </div>
    @enderror

    @if (isset($addonsLeft) or isset($addonsRight) or $attributes['datepicker'])
        </div>
    @endif

    @if ($attributes->has('horizontal-form'))
        </div>
    @endif
</div>

@if($attributes['datepicker'])
    @once
        <script src="{{ asset('assets\vendors\jquery\jquery.min.js')}}"></script>
        <script src="{{ asset('assets\vendors\bootstrap-datepicker\bootstrap-datepicker.min.js')}}"></script>
       {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> --}}
    @endonce
@endif
