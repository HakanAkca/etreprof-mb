@extends ('layout')

@section('content')


	<div id="vue">
	
		<div v-for="(ressources,jour) in contenus">
			<h4>@{{ jour }}</h4>
			<ul>
				<li v-for="contenu in ressources">@{{ contenu.date }} &mdash; <a :href="contenu.url">@{{ contenu.titre }}</a></li>
			</ul>

		</div>

	</div>

	<script>

	var contenus = {!! json_encode($contenus) !!};
	
	var dataVue = new Vue({
		  el:"#vue",
  		  data: {
  		  	contenus : contenus
  		  }
  		});
	</script>

@endsection


