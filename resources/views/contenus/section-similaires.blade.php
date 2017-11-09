<section>
<h3>@include('bloc', ['bloc' => 'contenus-similaires-titre', 'defaut' => 'D\'autres ressources sur ce thème'])</h3>
<div class="row no-gutter">
	@foreach ($similaires as $i => $contenu)
		<div class="col-sm-4">

		@include('contenus.bloc-carre', ['contenu' => $contenu, 'event' => 'connexes:#' . ($i+1), 'origin' => url()->full()])

		</div>
	@endforeach
	</div>
</section>