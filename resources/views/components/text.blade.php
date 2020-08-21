<!--
- class : バリデーションエラー時にis-invalidみたいなクラスを追記する
  - クラス名をどこで定義するか(設定ファイルに切り出す？)
  - クラス名を全て設定に切り出す？
- バリデーションエラーメッセージを出す
-->
<?php
    echo get_class($attributes);
?>
<input type="text" name="{{ $name }}" value="{{ $value }}" {{ $attributes }} />
@error('title')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
