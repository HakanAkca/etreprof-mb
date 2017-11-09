<!DOCTYPE html>
<html>
<head>

</head>
<body>
<p>Bonjour,</p>

<p>Un nouvel utilisateur vient de s'inscrire sur l'espace privé test.etre-prof.fr.</p>

<p>Vous devez valider son compte pour lui permettre de participer et de proposer ou valider des contenus.</p>

<p>Pour accéder à sa fiche, cliquez sur le lien ci-dessous :</p>

<h2><a href="{{ action('Admin\UtilisateursController@modifier', ['id' => $user->id ]) }}">Fiche de l'utilisateur</a></h2>

<p>A bientôt !</p>

</body>
</html>
