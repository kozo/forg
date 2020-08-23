<input id="{{ $id }}" type="text" name="{{ $name }}" value="{{ $value }}" class="{{ $class }}" {{ $attributes }} />
@error($name)
<div class="{{ $errorClass() }}">{{ $message }}</div>
@enderror
