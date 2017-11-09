<a href="{{ $contenu->url() }}" class="clickevent" data-event="{{ $event or null}}" data-origin="{{ $origin or null}}"><div class="bloc-carre" style="background-image:url({{ $contenu->image }}); background-size:cover">

	<div class="">
		@if ($contenu->score_avis)
					<div class="pull-right stars stars-small">
						<div class="stars-on" style="width: {{ $contenu->score_avis  / 5 * 100 }}%"></div>
					</div>
		@endif
		
		<div class="bloc-titre">

			<h3>{{ $contenu->titre }} @if (env('APP_DEBUG')) {{ round($contenu->score) }} {{ (!empty($contenu->niveau)) ? join(',', $contenu->niveau) : '-' }} @endif</h3>

			<div class="show-on-hover">
				<div class="label label-warning pull-right">{{ ($contenu->proposePar) ? $contenu->proposePar->name : '' }}</div>

				<p>{{ truncate(strip_tags(html_entity_decode($contenu->description)), 150) }}</p>
			</div>
		</div>
	</div>
</div>
</a>
