@extends('emails.layout')

@section('content')

    <p>Demande d'urgence par {{ $user->nom }}</p>

    <p>Type d'urgence: {{$donnees['select']}}</p>

    <p>Email: {{$donnees['email']}}</p>
    <p>Nom: {{$donnees['nom']}}</p>
    <p>Téléphone: {{$donnees['numero']}}</p>

    <p>Message : {{ $donnees['message'] }}</p>

@endsection