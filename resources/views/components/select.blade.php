<select id="{{ $id }}" class="{{ $class }}" name="{{ $name }}" {{ $attributes }} {{ $multipled() }}>
    @if($empty === true)
    <option value="">{{ $emptyText }}</option>
    @endif;
    @foreach ($options as $value=>$text)
    <option value="{{ $value }}" {{ $selected($value) }}>{{ $text }}</option>
    @endforeach
</select>
@error($parseArrayToDot($name))
<div class="{{ $errorClass() }}">{{ $message }}</div>
@enderror
