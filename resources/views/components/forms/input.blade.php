<div class="col-md-4">
    <label for="{{ $name }}">{{ $label }}</label>
</div>
<div class="col-md-8 form-group">
    <input 
        class="form-control @error($name) is-invalid @enderror" 
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        @if (strlen(old($name)) > 0)
            value="{{ old($name) }}"
        @endif
    >
    @error($name)
    <div class="invalid-feedback">
        <i class="bx bx-radio-circle"></i>
        {{ $message }}
    </div>
    @enderror
</div>