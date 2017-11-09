@extends('admin.layout')


@section('content')
	<a href="{{ action('Admin\CategoriesController@index') }}"><span class="glyphicon glyphicon-arrow-left"></span> Revenir à la liste</a>

	<h1>Terme de catégorie : {{ $vocabulaire->name }}</h1>

	<div id="vue">
		{!! Form::model($terme) !!}

		@include('form.element', [ 'element' => [
							'Nom du terme',
							Form::text('name', null, [
								'class' => 'form-control'
							])
						]])

		@include('form.element', [ 'element' => [
							'Terme parent',
							Form::select('parent', [ 0=>'---'] + $termes, null, [
								'class' => 'form-control'
							])
						]])


		@include('form.element', [ 'element' => [
							'Poids (ordre d\'affichage)',
							Form::number('weight', null, [
								'class' => 'form-control'
							])
						]])

		<div class="text-center">

			<input type="submit" class="btn btn-primary btn-lg" value="Enregistrer">

		</div>
		{!! Form::close() !!}
	</div>


@endsection