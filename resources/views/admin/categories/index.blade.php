@extends('admin.layout')


@section('content')

	@if (Auth::user()->possedeDroit('modifier_vocabulaire'))
		<div class="pull-right"><a href="/admin/categories/modifier" class="btn btn-primary btn-lg">Ajouter une catégorie</a></div>
	@endif

	<h1>Catégories</h1>

	<div id="vue">
		<table class="table table-striped">

		<tr>
			<th></th>
		</tr>

		@foreach ($vocabulaires as $vocabulaire)
		<tr>
			<td><a href="{{ action('Admin\CategoriesController@termes', ['id' => $vocabulaire->id]) }}">{{ $vocabulaire->name }}</a></td>
			<td>{{ $vocabulaire->terms()->count() }}</td>
			<td>
			@if (Auth::user()->possedeDroit('modifier_vocabulaire'))
				<a href="/admin/categories/modifier/{{ $vocabulaire->id }}" class="btn btn-primary btn-sm">Renommer</a>
			@endif
			</td>
			<td></td>

		</tr>
		@endforeach
		</table>
	</div>


@endsection