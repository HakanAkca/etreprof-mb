@extends ('layout')

@section('content')

		<div class="row">

			<div class="col-sm-8">
				<h1>@include('bloc', ['bloc' => 'recherche-titre', 'default' => "Voici ce que nous avons trouvé dans les cartons !"])</h1>

				@if (count($contenus) == 0)
					@include('recherche.0resultat')
				@else
					<div class="row no-gutter">
					@foreach ($contenus as $i => $contenu)
						@if ($i >= 6)
							@break
						@endif
						<div class="col-sm-6">

						@include('contenus.bloc-carre', [
								'contenu' => $contenu, 
								'origin' => url()->full(), 
								'event' => 'recherche:#' . ($i+1)
						])

						</div>
					@endforeach
					</div>
					@include('recherche.ameliorer')

				@endif
			</div>

			<div class="col-sm-offset-1 col-sm-3">
				@include('contenus.recommandations')
			</div>

		</div>

		@if (count($contenus) > 6)
			
			<div>
			<h2>@include('bloc', ['bloc' => 'recherche-autres-ressources', 'default' => "Autres ressources sur ce thème"])</h2>
			<div class="row">
				@foreach ($contenus as $i => $contenu)
					@if ($i < 6)
						@continue
					@endif
					<div class="col-xs-6 col-sm-4 col-md-3">

						@include('contenus.bloc-carre', [
							'contenu' => $contenu, 
							'origin' => url()->full(), 
							'event' => 'recherche:#' . ($i+1)
						])

					</div>
				@endforeach
			</div>
			</div>				
			

		@endif


	@include('index.categories')

@endsection