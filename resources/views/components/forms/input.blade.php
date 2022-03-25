<label class="col-md-4" for="{{ $name }}">{{ $label }}</label>

<div class="col-md-8 form-group">
    <input 
        class="form-control @if (old('_token') != null) @error($name) is-invalid @else is-valid @enderror @endif" 
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
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
</div>