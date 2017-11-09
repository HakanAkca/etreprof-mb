<!DOCTYPE html>
<html>
<head>
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
<link rel="stylesheet" type="text/css" href="/css/app.css?m={{ filemtime(public_path('css/app.css')) }}">
<script src="/js/app.js?m={{ filemtime(public_path('js/app.js')) }}"></script>
</head>
<body>
{!! csrf_field() !!}
<!--div id="appModal">
	<modal v-if="showModal" @close="showModal = false">
	    <!- -
	      you can use custom content here to overwrite
	      default content
	    - ->
	    <h3 slot="header" v-html="header">@{{ header }}</h3>
	    <div slot="body" v-html="body">@{{ body }}</div>
	    <div slot="footer" v-html="footer">@{{ footer }}</div>
	</modal>
  <!- -button id="show-modal" @click="showModal = true">Show Modal</button- ->
  <!-- use the modal component, pass in the prop - ->
  <!--modal v-if="showModal" @close="showModal = false">
    <!--
      you can use custom content here to overwrite
      default content
    - ->
    <!--h3 slot="header">@{{header}}</h3>
    <div slot="body">@{{body}}</div>
    <div slot="footer">@{{footer}}</div- ->
  <!--/modal- ->
</div--><!-- #modal -->

<div class="wrapper">



			<div class="sidebar">
				<div id="logo" class="text-center"><a href="/"><img src="/img/logo.png"></a></div>

				<div class="colGauche">
					<ul class="nav nav-pills nav-stacked">
						@foreach ($menuPrincipal as $item)
						<li role="presentation" class="{{ ((!empty($activeMenu) && $activeMenu == $item->url) || (!empty($activeMenuTrail) && $activeMenuTrail == $item->url)) ? 'active' : '' }}"><a href="{{ $item->url }}">{{ $item->text }}</a>
							@if ($item->children)
							<ul class="">
								@foreach ($item->children as $child)
									<li class="{{ (!empty($activeMenu) && $activeMenu == $child->url) ? 'active' : '' }}"><a href="{{ $child->url }}">{{ $child->text }}</a></li>
								@endforeach
							</ul>
							@endif
						</li>
						@endforeach
					</ul>

				<div class="boutons text-center">
					@foreach ($boutonsGauche as $bouton)
						<p>
						<a href="{{ $bouton->url }}" class="btn btn-info {{ (!empty($activeMenu) && $activeMenu == $bouton->url) ? 'active' : '' }}">{{ $bouton->text }}</a>
						</p>
					@endforeach
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="text-right">
				<div id="identite">
					Bienvenue {{  $user->name or 'anonyme' }} ({{ (!empty($user->role)) ? $user->role->code : 'aucun droit' }}) | <a class="logout">Quitter</a>

				</div>
			</div>

			<div class="panel">
				<div class="panel-body">

				<div class="flash-message">
				  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
				    @if(Session::has('alert-' . $msg))
				    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
				    @endif
				  @endforeach
				</div>

				@section('content')

				@show
				</div>
			</div>
		</div>


	<div class="footer">
		<div class="text-center text-muted">
		Login : {{ $user->email }}
		</div>
	</div>

</div><!-- .container -->


</body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43049438-5', 'auto');
  ga('send', 'pageview');

</script>
</html>
