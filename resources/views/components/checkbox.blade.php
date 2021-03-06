<!--
  -  class名を外出し(typeごとに設定作った方がいいかも)
-->
@foreach ($options as $value=>$text)
<div class="form-check">
    <input class="form-check-input" type="checkbox" name="{{ $name }}" id="{{ $id . '_' . $loop->index }}" value="{{ $value }}" {{ $attributes }} >
    <label class="form-check-label" for="{{ $id . '_' . $loop->index }}">
        {{ $text }}
    </label>
    @error($parseArrayToDot($name))
    <div class="{{ $errorClass() }}">{{ $message }}</div>
    @enderror
</div>
@endforeach
