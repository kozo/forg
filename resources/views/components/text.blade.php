<input id="{{ $id }}" type="text" name="{{ $name }}" value="{{ $value }}" class="{{ $class }}" {{ $attributes }} />
@error($name)
<div class="alert alert-danger">{{ $message }}</div>
@enderror
