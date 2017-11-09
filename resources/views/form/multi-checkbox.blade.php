@foreach ($options as $cle => $option)
	<div><label>{!! Form::checkbox($name, $cle, ((in_array($cle, $values)) ? 1 : 0), $attributes) !!} {!! $option !!} </label></div>
@endforeach