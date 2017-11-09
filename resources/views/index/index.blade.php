@extends ('layout')

@section('class', 'home')

@section('content')


<div class="jumbotron diagnostic">
	@include('admin.editer-bloc', ['bloc' => $blocs['home-autodiagnostic']])
	{!! $blocs['home-autodiagnostic']->html !!}
</div>

<div class="row">

	<div class="col-sm-8">

		@include('index.top-ressources', ['featured' => $featured])

		@include('index.section-dossier')

		@include('index.categories')

	</div>

	<div class="col-sm-offset-1 col-sm-3">
		@include('contenus.recommandations')
	</div>

</div>



<div class="jumbotron missions">
	<div class="text-center titre">
	@include('admin.editer-bloc', ['bloc' => $blocs['home-missions-titre']])
	{!! $blocs['home-missions-titre']->html !!}
	</div>

	<div class="row">
		@for ($i = 1; $i <= 4; $i++)
			<div class="col-xs-6 col-sm-3 item">
			@include('admin.editer-bloc', ['bloc' => $blocs['home-missions-bloc' . $i]])
			<div class="tilt">{!! $blocs['home-missions-bloc' . $i]->html !!}</div>
			</div>

		@endfor
	</div>

	<div class="text-center">
	@include('admin.editer-bloc', ['bloc' => $blocs['home-missions-lien']])
	{!! $blocs['home-missions-lien']->html !!}
	</div>

</div>


@endsection