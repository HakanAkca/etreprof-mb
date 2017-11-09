@extends('emails.layout')

@section('content')
<p>Retour de {{ $user->name }} : </p>

<blockquote>{{ $feedback->feedback }}</blockquote>

@if ($user->id)
	<h2><a href="{{ action('Admin\UtilisateursController@modifier', ['id' => $user->id ]) }}">Fiche de l'utilisateur</a></h2>
@endif

<p>A bientôt !</p>

@endsection