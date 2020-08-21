<!--
<form method="POST" action="http://php73.saku.jp/rise/public/proposals" accept-charset="UTF-8">
-->
<form action="{{ $action }}" method="{{ $method }}" accept-charset="{{ $charset }}" {{ $attributes }}>
@csrf
@method('PUT')
