<section>
<h2>@include('admin.editer-bloc', ['bloc' => $blocs['home-titre-top-ressources']])
	{!! $blocs['home-titre-top-ressources']->html !!}</h2>
<div class="row no-gutter">
	@foreach ($featured as $i => $contenu)
		<div class="col-xs-6 col-sm-4">

		@include('contenus.bloc-carre', ['contenu' => $contenu, 'event' => 'home:top:#' . ($i+1)])

		</div>
	@endforeach
	</div>
</section>