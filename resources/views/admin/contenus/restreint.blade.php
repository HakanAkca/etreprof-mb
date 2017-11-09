@extends ('admin.layout')

@section('content')

	@include('admin.contenus.form-nav', ['etape' => 'lien'])
	
	<div>
		<h2>Accès réservé.</h2>
		<p> Vous devez obtenir un accès auprès de l'équipe pour accéder à cette page. <a href="#" class="logout">Quitter</a></p>
	</div>


@endsection