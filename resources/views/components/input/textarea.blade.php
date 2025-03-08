@php
    $errorName = str_replace(['[', ']'], ['.', ''], $name);
@endphp

<textarea class="form-control {{$errors->has($errorName) ? "is-invalid" : (old($name) ? "is-valid" : " ") }}" name="{{$name}}" rows="5" placeholder="{{ __($placeholder) }}">
    {{ old($name, $value ?? '') }}
</textarea>
<div class="invalid-feedback">
    @error($errorName)
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
