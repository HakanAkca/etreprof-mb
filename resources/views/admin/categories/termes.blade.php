@extends('admin.layout')


@section('content')
	<a href="{{ action('Admin\CategoriesController@index') }}"><span class="glyphicon glyphicon-arrow-left"></span> Revenir à la liste</a>

	@if (Auth::user()->possedeDroit('modifier_vocabulaire'))
		<div class="pull-right"><a href="{{ action('Admin\CategoriesController@terme', ['vocabulary_id' => $vocabulaire->id ]) }}" class="btn btn-primary btn-lg">Ajouter un terme</a></div>
	@endif

	<h1>Catégorie : {{ $vocabulaire->name }}</h1>

	<div id="vue">
		<table class="table table-striped">

		<tr>
			<th></th>
		</tr>

		@foreach ($termes as $key => $terme)
		<tr id="t{{ $terme->id }}">
			<td>
			@if ($terme->parent)
				&mdash;
			@else
				<big><strong>
			@endif

			<a href="{{ action('Admin\CategoriesController@terme', ['vocabulary_id' => $terme->vocabulary_id, 'term_id' => $terme->id]) }}">{{ $terme->name }}</a>

			@if (!$terme->parent)
				</big></strong>
			@endif
			</td>
			<td>
				<a href="{{ action('Admin\ContenusController@listeParTermeJson', ['terme_id' => $terme->id]) }}" class="data"><span class="glyphicon glyphicon-eye-open"></span></a>
			</td>
			<td>
			@if (Auth::user()->possedeDroit('modifier_vocabulaire'))
				<a data-href="{{ action('Admin\CategoriesController@postSupprimerTerme', ['terme_id' => $vocabulaire->id ]) }}" data-id="{{ $terme->id }}" class="btn btn-default btn-sm supprimer">Supprimer le terme</a>
			@endif
			</td>

		</tr>
		@endforeach
		</table>
	</div>

	<script>

		$(function() {
			function fetchContenus(id) {
				return $.getJSON('/admin/contenus/liste-par-terme/' + id + '.json');

			};

			$('.supprimer').click(function() {
				var terme_id = $(this).attr('data-id');
				fetchContenus(terme_id)
					.then(function(json) {
						var msg = 'Il y a ' + json.length + " contenus associés :\n";
						msg += json.map(function(i) { return ' - ' + i.titre } ).join("\n");
						if (confirm(msg)) {
							return $.post('/admin/categories/supprimer-terme', { terme_id : terme_id, _token: $('input[name="_token"]').val()});
						};
					}).then(function(ret) {
						if (ret == 'ok') {
							$('#t' + terme_id).css('background', 'red').slideUp();
						}
					});
			});
		});
	</script>

@endsection