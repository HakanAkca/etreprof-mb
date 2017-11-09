@extends('admin.layout')


@section('content')

	@include('admin.contenus.form-nav', ['etape' => 'avis'])

	<h1>Avis / <strong>{{ $contenu->titre }}</strong></h1>

	<div id="vue">

	<div class="well">

		<div class="row">

			<div class="col-sm-6">
				@include('admin.contenus.preview', ['contenu' => $contenu])
			</div>

			<div class="col-sm-6">
				{!! $contenu->description !!}

				<p><strong>Mots-clés :</strong> {!! $contenu->tags !!}</p>

				<p>@foreach ($contenu->related as $related)
					<span class="label label-default">{{ $related->term->name }}</span>

				@endforeach
				</p>

				@foreach ($liste_avis as $avis)
					<div class="">
					<h3>Avis de {{ $avis->evaluateur->name }}
					@if (Auth::user()->possedeDroit('modifier_tous_avis'))
						<a href="{{ action('Admin\ContenusController@avis', ['id' => $contenu->id, 'avis_id' => $avis->id]) }}" class="btn btn-sm btn-default">Modifier cet avis</a>
					@endif
					</h3>
					<p>Fond : {!! \App\Contenu::etoiles($avis->note_fond) !!} /
					Forme : {!! \App\Contenu::etoiles($avis->note_forme) !!} /
					Accessibilité : {!! \App\Contenu::etoiles($avis->note_accessibilite) !!}
					@if ($avis->waouh)
						/ {!! App\Contenu::coeurs(1) !!} WAOUH !
					@endif
					</p>
					@if ($avis->commentaires)
						<p>Commentaire : {{ $avis->commentaires }}</p>
					@endif
					</div>
				@endforeach
			</div>
		</div>

	</div>



		{!! Form::model($mon_avis, ['class' => 'form-horizontal']) !!}
		{!! csrf_field() !!}

			<fieldset>
				<legend>{{ (!empty($mon_avis->evaluateur) AND $mon_avis->evaluateur_id != Auth::user()->id) ? 'Avis de ' . $mon_avis->evaluateur->name : 'Votre avis' }}</legend>


				<div class="row">

					@foreach ([
						'note_fond' => [
							'label' => 'Sur le fond',
							'options' => [
								3 => App\Contenu::etoiles(3) . ' Très intéressant',
								2 => App\Contenu::etoiles(2) . ' Intéressant',
								1 => App\Contenu::etoiles(1) . ' Bof'
							]
						],
						'note_forme' => [
							'label' => 'Sur la forme',
							'options' => [
								3 => App\Contenu::etoiles(3) . ' Attirant, pratique',
								2 => App\Contenu::etoiles(2) . ' Correcte',
								1 => App\Contenu::etoiles(1) . ' Peu pratique ou vieillot'
							]
						],
						'note_accessibilite' => [
							'label' => 'Sur la forme',
							'options' => [
								3 => App\Contenu::etoiles(3) . ' Abordable, accessible facilement',
								2 => App\Contenu::etoiles(2) . ' Demande de l\'expérience/du temps',
								1 => App\Contenu::etoiles(1) . ' Trop long/lourd/complexe'
							]
						]
					] as $key => $note)
						<div class="col-sm-4">
						<label>{{ $note['label'] }} :</label>
						{!!	Form::radios($key, $note['options'], null,
							['required' => true]) !!}
						</div>
					@endforeach

				</div>

			</fieldset>

			<fieldset>
				<legend>Coup de coeur</legend>
			@include('form.element', [ 'element' => [
				'Inspirant : avez-vous eu un coup de c&oelig;ur ?',
				Form::radios('waouh', [
					'1' => App\Contenu::coeurs(1) . ' WAOUH ! Je recommande ce contenu inspirant',
					'0' => 'Pas à ce point...'
				])

			]])
			</fieldset>


			<fieldset>
			@include('form.element', [ 'element' => [
				'Vos commentaires',
				Form::textarea('commentaires', null, [
					'class' => 'form-control',
					'rows' => 4
				])

			]])

			</fieldset>


		<div class="text-center">

				<input type="submit" v-if="lien.titre && lien.url" class="btn btn-lg btn-primary" value="Publier mon avis">

				</div>
		{!! Form::close() !!}

		</div>


		<!-- #vue -->
	</div>



@endsection