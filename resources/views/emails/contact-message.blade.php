@extends('emails.layout')

@section('content')

    <p>Demande de contact par {{ $user->nom }}</p>

    <p>Message : {{ $valeurs['message'] }}</p>

@endsection