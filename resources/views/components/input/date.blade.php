<input type="date" name="{{ $name }}" class="form-control me-3" value="{{ request()->query($name) }}">
<div class="invalid-feedback">
    @error($name)
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
