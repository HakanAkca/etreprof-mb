<div class="jumbotron recherche">
@if (!empty($user) && $user->possedeDroit('acces_front'))
		<div class="container">
			{!! Form::open(['url' => action('RechercheController@requete'), 'method' => 'get']) !!}
				@if (trim($__env->yieldContent('class')) == 'home')
					<h1 class="text-center">@include('bloc', ['bloc' => 'baseline-home', 'default' => 'Etre Prof. Cheminer ensemble, cours après cours.'])</h1>
				@endif
				<div class="row no-gutter">
					<h4 class="col-xs-12 col-md-4 col-sm-5 col-md-offset-1 text-center">
					<label>Pour ma classe, je cherche :</label>
					</h4>
					<div class="col-sm-5 col-xs-8 col-xs-offset-1 col-sm-offset-0">
						<div class="">
						{!! Form::text('recherche', ((!empty($recherche)) ? $recherche : null), [
							'class' => 'form-control',
							'placeholder' => 'Exercices lecture, Dyslexie, Activité sur l’eau...'
						]) !!}

						</div>
					</div>
					<div class="col-xs-1">
						&nbsp;<button type="submit" class="btn btn-link btn-sm"><span class="glyphicon glyphicon-search text-white mirror"></span></button>
					</div>
					<div class="col-xs-1">
						@if(empty($recherche))
							<a role="button" data-toggle="collapse" href="#criteres" aria-expanded="false" aria-controls="collapseExample">Recherche avancée</a>
						@endif
					</div>

				</div>
				<div class="{{ (!empty($recherche)) ? '' : 'collapse' }}" id="criteres">
				@include('recherche.criteres')
				</div>
			{!! Form::close() !!}

		</div>
@endif
	</div><!-- .jumbotron -->