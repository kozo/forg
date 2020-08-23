<select id="{{ $id }}" class="{{ $class }}" name="{{ $name }}">
    @if($empty === true)
    <option value="">{{ $emptyText }}</option>
    @endif;
    @foreach ($options as $value=>$text)
    <option value="{{ $value }}" {{ $selected($value) }}>{{ $text }}</option>
    @endforeach
</select>
@error($name)
<div class="alert alert-danger">{{ $message }}</div>
@enderror
