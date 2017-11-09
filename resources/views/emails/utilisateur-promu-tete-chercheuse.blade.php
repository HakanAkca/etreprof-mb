@extends('emails.layout')

@section('content')
<p>Bonjour,</p>

<p>Votre compte utilisateur·rice a été activé et vous avez désormais accès à l'espace tête chercheuse etreprof.fr !</p>

<p>Pour vous y accéder, rendez-vous sur la page suivante : </p>

<h2><a href="{{ action('Admin\ContenusController@index') }}">Espace Tête Chercheuse</a></h2>

<p>Votre identifiant : {{ $user->email }}</p>
<p>Votre mot de passe : ***** (vous seul·e le connaissez !)</p>



<p>A bientôt !</p>

</body>
</html>
