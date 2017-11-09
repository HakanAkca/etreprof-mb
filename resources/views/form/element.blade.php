<?php
	$name = $element[0];
	$input = $element[1];
?>

<div class="form-group" id="{{ $name }}-element" @if (!empty($element[3])) @foreach($element[3] as $att => $val)
{{ $att }}="{!! $val !!}" @endforeach @endif>
	<label class="col-sm-4 control-label">{!! $element[0] !!} <span class="mandatory"></span></label>
	<div class="col-sm-7">

	{!! $input !!}

	@if (!empty($element[2]))
		<div class="description">{!! $element[2] !!}</div>
	@endif
	</div>
</div>
<script>
$(function() {
	$('input,textarea')
		.focus(function() {
			$(this).parents('.form-group:first').addClass('focus');
		})
		.blur(function() {
			$(this).parents('.form-group:first').removeClass('focus');
		});
});
</script>