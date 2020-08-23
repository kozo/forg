<select id="{{ $id }}" class="{{ $class }}" name="{{ $name }}" {{ $multipled() }}>
    @if($empty === true)
    <option value="">{{ $emptyText }}</option>
    @endif;
    @foreach ($options as $value=>$text)
    <option value="{{ $value }}" {{ $selected($value) }}>{{ $text }}</option>
    @endforeach
</select>
@error($name)
<div class="{{ $errorClass() }}">{{ $message }}</div>
@enderror
