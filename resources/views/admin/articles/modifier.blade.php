@extends('admin.layout')


@section('content')
	
	
	{!! Form::model($article, ['class' => 'form']) !!}
	{!! csrf_field() !!}

	@include('form.errors')

	<div class="row">

		<div class="col-sm-9">
			<fieldset>
				<legend>{{ $article->typeNom() }}</legend>
				{!! Form::hidden('type') !!}

				@include('form.element', [ 'element' => [
					'Titre',
					Form::text('title', null, [
						'class' => 'form-control'
					])
				]])

				@include('form.element', [ 'element' => [
					'Adresse (remplissage automatique)',
					Form::text('url', null, [
						'class' => 'form-control'
					])
				]])

				<div class="form-group">
				<label>Corps de texte</label>

				{!! Form::textarea('content', null, [
						'class' => 'form-control',	
						'id' => 'content_textarea',					
						'placeholder' => ""
						])
				!!}
				</div>

				@if (in_array($article->type, ['post', 'theme']))

					<div class="form-group">
					<label>Résumé/accroche</label>
					{!! Form::textarea('excerpt', null, [
							'class' => 'form-control',
							'id' => '',
							'rows' => 2,
							'placeholder' => ""
							])
					!!}
					</div>
				@endif

				@if ($article->type == 'theme')

					<div class="form-group">
					<label>Code d'intégration HTML (vidéo/flash/<a href="/image-map-pro/editor.html" target="_blank">code d'image dynamique avec l'éditeur Image Map Pro</a>)</label>
					{!! Form::textarea('embed', null, [
							'class' => 'form-control',
							'id' => '',
							'rows' => 4,
							'placeholder' => ""
							])
					!!}
					</div>
				@endif

			</fieldset>

		</div>

		<div class="col-sm-3">
			<div class="panel panel-primary">
				<div class="panel-heading">Image/bandeau</div>

				<div class="panel-body">
					<div class="input-group">
					   <span class="inpaut-group-btn">
						 <a data-input="thumbnail" data-preview="holder" class="lfm_open btn btn-primary btn-sm">
						   <i class="fa fa-picture-o"></i> Choisir
						 </a>
					   </span>
					   {!! Form::text('thumbnail', null, ['id' => 'thumbnail', 'class' => "form-control input-sm"]) !!}
					</div>
					<a class="lfm_open" data-input="thumbnail" data-preview="holder"><img id="holder" style="margin-top:15px;max-width:100%;" src="{{ $article->thumbnail ? $article->thumbnail : '//:0' }}"></a>
				</div>
			</div>

			<div class="panel panel-primary">
				<div class="panel-heading">Publication</div>

				<div class="panel-body">

					@if ($article->type == 'theme')
						<label>
						{!! Form::hidden('featured', 0) !!}
						{!! Form::checkbox('featured', 1, null, []) !!}
						Promouvoir sur la page d'accueil
						</label>
					@endif

					<label>Date (ordre d'apparition) :</label>
					{!! Form::text('date', null, ['class' => "form-control input-sm"]) !!}

					<div class="text-center">
						<input type="submit" class="btn btn-lg btn-primary" value="Enregistrer">
					</div>
				</div>
			</div>
		</div><!-- . col -->
	</div><!-- .row -->

	{!! Form::close() !!}

	@include('editeur.full', ['id' => 'content_textarea'])

@endsection