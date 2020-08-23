<!--
  -  class名を外出し(typeごとに設定作った方がいいかも)
-->
@foreach ($options as $value=>$text)
<div class="form-check">
    <input class="form-check-input" type="radio" name="{{ $name }}" id="{{ $id . '_' . $loop->index }}" value="{{ $value }}">
    <label class="form-check-label" for="{{ $id . '_' . $loop->index }}">
        {{ $text }}
    </label>
    @error($name)
    <div class="{{ $errorClass() }}">{{ $message }}</div>
    @enderror
</div>
@endforeach
