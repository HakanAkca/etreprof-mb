@foreach ($options as $cle => $option)
	<div><label>{!! Form::radio($name, $cle, (($value == $cle) ? 1 : 0), $attributes) !!} {!! $option !!} </label></div>
@endforeach