<input id="{{ $id }}" type="text" name="{{ $name }}" value="{{ $value }}" class="{{ $class }}" {{ $attributes }} />
@error($parseArrayToDot($name))
<div class="{{ $getConfig('text.error_message_class') }}">{{ $message }}</div>
@enderror
