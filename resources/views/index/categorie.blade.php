@extends ('layout')

@section('content')

	<div class="row">

	<div class="col-sm-8">

		<h1>{{ $terme->name }}</h1>

		@foreach ($contenus as $contenu)
		<div class="col-sm-4">

		@include('contenus.bloc-carre', ['contenu' => $contenu])

		</div>
		@endforeach

		<div class="clearBoth">
		@include('index.categories')
		</div>

	</div>

	<div class="col-sm-offset-1 col-sm-3">
		@include('contenus.recommandations')
	</div>

	</div>

	<div class="row no-gutter">
		</div>





@endsection