<div class="col-md-4">
    <label for="{{ $name }}">{{ $label }}</label>
</div>
<div class="col-md-8 form-group">
    <input 
        class="form-control" 
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        @if (strlen(old($name)) > 0)
            value="{{ old($name) }}"
        @endif
    >
</div>
@error($name)
<div class="alert alert-danger">{{ $message }}</div>
@enderror