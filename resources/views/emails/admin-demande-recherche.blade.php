@extends('emails.layout')

@section('content')
<p>Demande de ressource par {{ $user->name }} ({{ $user->email }}) : </p>

<blockquote><h3>{{ $requete }}</h3></blockquote>

<p>Cet·te utilisateur·trice a demandé à recevoir des ressources supplémentaires. Voici le résultat actuel de sa recherche :</p>

<p><a href="{{ $url }}">{{ $url }}</a></p>

@if ($user->id)
	<p><a href="{{ action('Admin\UtilisateursController@modifier', ['id' => $user->id ]) }}">Fiche de l'utilisateur</a></p>
@endif

<p>A bientôt !</p>

@endsection