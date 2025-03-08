<input type="number" class="form-control {{$errors->has($name) ? "is-invalid" : (old("$name") ? "is-valid" : " ") }}" min="1" step="1" name="{{$name}}" placeholder="{{$placeholder}}" value="{{ old($name) ? old($name) : $placeholder }}">
<div class="invalid-feedback">
    @error($name)
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
