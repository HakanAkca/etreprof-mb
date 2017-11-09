<div class="row">

	@foreach (['Thématiques' => $categories['thematique'], 'Discipline' => $categories['discipline'], 'Niveaux' => $categories['niveau']] as $vocabulaire => $termes)
		<div class="col-sm-4">


			<h3>{{ $vocabulaire }}</h3>
			<ul class="cats">
			@foreach ($termes as $terme)
				<li><a href="{{ action('IndexController@categorie', [$terme->id, str_slug($terme->name)]) }}">{{ $terme->name }}</a></li>
				@foreach ($terme->childrens as $child)
					<li><a href="{{ action('IndexController@categorie', [$child->id, str_slug($child->name)]) }}">{{ $child->name }}</a></li>
				@endforeach

			@endforeach
			</ul>

			</div>
	@endforeach

</div>
