@extends('emails.layout')

@section('content')

    <p>Nouveau commentaire de la part de {{ $user->name }} </p>

    <p>Voir le commentaire : <a href="{{$contenu->url()}}#c{{$commentaire->id}}">{{$contenu->titre}}</a></p>

	@include('emails.signature')
	
@endsection