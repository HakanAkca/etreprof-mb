@extends('admin.layout')


@section('content')

	@include('admin.contenus.form-nav', ['etape' => 'identite'])

	<h1>MERCI !</h1>

	<p>Votre contenu a été proposé. Il sera relu et d'autres membres devront l'évaluer avant sa publication.</p>

	<div class="panel">

	<div class="row">
		<div class="col-sm-4 text-center">
			<a href="/admin/contenus/avis/{{ $contenu->id }}" class="btn btn-danger"><span class="glyphicon glyphicon-comment"></span> Donner mon avis</a>
		</div>

		<div class="col-sm-4 text-center">
			<a href="/admin/contenus/lien" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Proposer un nouveau contenu</a>
		</div>

		<div class="col-sm-4 text-center">
			<a href="/admin/contenus" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Revenir à la liste</a>
		</div>
	</div>

	</div>

	<div class="jumbotron">
		@include('admin.contenus.preview', ['contenu' => $contenu])
	</div>
@endsection