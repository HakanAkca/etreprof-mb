@extends('layout')


@section('content')

	@include('admin.boutons-editer',
		['if' => Auth::user()->possedeDroit('modifier_structure'),
		'url' => action('Admin\ArticlesController@modifier', ['page', $article->id])
	])


	<div class="panel">
	<div class="panel-body">
		<h1 class="page-title">{{ $article->title }}</h1>

		<div id="vue" class="page-content">

		{!! $article->content !!}
		</div>
	</div>
	</div>

@endsection