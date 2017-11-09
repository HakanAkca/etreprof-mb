@extends('admin.layout')


@section('content')
	<a href="{{ action('Admin\CategoriesController@index') }}"><span class="glyphicon glyphicon-arrow-left"></span> Revenir à la liste</a>

	<h1>Modifier une catégorie</h1>

	<div id="vue">
		{!! Form::model($vocabulaire) !!}
		@include('form.element', [ 'element' => [
							'Nom de la catégorie',
							Form::text('name', null, [
								'class' => 'form-control'
							])
						]])


		<div class="text-center">

			<input type="submit" class="btn btn-primary btn-lg" value="Enregistrer">

		</div>
		{!! Form::close() !!}
	</div>


@endsection