@extends('admin.layout')


@section('content')


@include('admin.contenus.form-nav', ['etape' => 'publier'])

<h1>Publié / <strong>{{ $contenu->titre }}</strong></h1>

<div class="alert alert-success">
	<h2>Contenu publié !</h2>
	<p>Ce contenu est actuellement publié et visible en ligne à l'adresse suivante :</p>
	<p><a href="{{ $contenu->url() }}">{{ $contenu->url() }}</a></p>

	<p><a href="/admin/contenus#etat-apublier">Voir la liste des contenus à publier </a></p>
</div>

<div id="vue">

	<div class="jumbotron">
	@include('admin.contenus.preview', ['contenu' => $contenu])
	</div>

	{!! Form::model($contenu, ['url' => action('Admin\ContenusController@postDepublier', $contenu->id), 'class' => 'form-horizontal']) !!}
	{!! csrf_field() !!}

	<div class="text-center">

		<input type="submit" class="btn btn-lg btn-primary" value="Dépublier ce contenu">
		<br>
		<small>Il sera visible dans l'espace têtes chercheuses mais ne sera plus visible publiquement par les visiteurs du site</small>

	</div>

	{!! Form::close() !!}


	@include('admin.contenus.supprimer')

</div><!-- #vue -->

@endsection