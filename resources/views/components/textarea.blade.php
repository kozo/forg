<!--
  - colsは不要かも
-->
<textarea id="{{ $id }}" class="{{ $class }}" name="{{ $name }}" rows="{{ $getConfig('textarea.rows') }}" cols="{{ $getConfig('textarea.cols') }}" {{ $attributes }}>{{ $value }}</textarea>
@error($name)
<div class="{{ $errorClass() }}">{{ $message }}</div>
@enderror
