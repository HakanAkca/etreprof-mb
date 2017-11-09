<section>
<h2><small>@include('bloc', ['bloc' => 'sidebar-recommandations-titre'])</small></h2>
<div class="">
	@foreach ($contenus as $i => $contenu)


		@include('contenus.bloc-carre', ['contenu' => $contenu, 'event' => 'reco:#' . ($i+1), 'origin' => url()->full() ])


	@endforeach
</div>
</section>