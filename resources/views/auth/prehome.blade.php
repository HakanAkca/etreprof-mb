<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, maximum-scale=1.0" />

<meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="fr">
<meta name="author" content="">
<meta http-equiv="Reply-to" content="@.com">
<meta name="generator" content="PhpED 8.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="creation-date" content="09/06/2012">
<meta name="revisit-after" content="15 days">
<title>@yield('title')</title>
<link rel="stylesheet" type="text/css" href="/css/public.css?m={{ filemtime(public_path('css/public.css')) }}">
<script src="/js/app.js?m={{ filemtime(public_path('js/app.js')) }}"></script>
@include('cookie-consent')
</head>
<body class="@yield('class')">

@section('content')
	<style>
	html,
	

	
	body {
		background: none
	}
	html {
		background: transparent url('/img/prof-peinture.jpg') no-repeat center center fixed;
		background-size: cover;
	}

	.overlay {
		background:rgba(255,255,255,0.7);
		padding:5%;
	}
	@media only screen and (min-width:768px) {
		

		.flex {
			margin: 5%;

		}
		    /*position: fixed;
		    top: 50%;
		    transform: translateY(-50%);*/
	
	}
	</style>
	
	<div class="flex">
		<div class="overlay">
			
			<div class="coantainer">

				@include('bloc', ['bloc' => 'prehome-texte', 'default' => 'Bienvenue sur le site EtreProf, version bêta'])


				<div class="row">

				<div class="col-sm-6">

					<h2>@include('bloc', ['bloc' => 'prehome-inscription-titre', 'default' => 'Créer un compte'])</h2>
					@include('auth.section-register')
				</div>

				<div class="col-sm-6">

					<h2>@include('bloc', ['bloc' => 'prehome-connexion-titre', 'default' => 'Me connecter'])</h2>
					@include('auth.section-login')
				</div>

				</div>
			</div>

		</div>
	</div>

<modal-container></modal-container>
<feedback-button></feedback-button>


@show

@include('analytics')
</body>
</html>
