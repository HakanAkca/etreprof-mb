<?php

use Illuminate\Foundation\Inspiring;

use App\Events\UtilisateurInscritEvent;
use App\Events\UtilisateurPromuTeteChercheuseEvent;
use App\User;
use App\Contenu;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('user:new {id}', function($id) {
	event(new UtilisateurInscritEvent(App\User::find($id)));


});
Artisan::command('user:tetechercheuse {id}', function($id) {
	event(new UtilisateurPromuTeteChercheuseEvent(App\User::find($id)));


});
Artisan::command('users:recalculer', function() {
	foreach (User::all() as $user)
	{
		$nb = $user->recalculerNbContributions();
		print $user->email . ':' . $nb . " \r\n";
	}
});
Artisan::command('votes:recalculer', function() {
	foreach (Contenu::all() as $contenu)
	{
		$contenu->recalculerVotes();
		print $contenu->id . "\r\n";
	}
});
Artisan::command('images:save {nb?}', function($nb = 10) {
	$i =0;
	foreach (Contenu::all() as $contenu)
	{
		if ($i++ < $nb)
		{
			print $i . $contenu->image . " -> ";
			$contenu->sauverImage(true);
			print $contenu->image . "\r\n" ;
		}

	}
});