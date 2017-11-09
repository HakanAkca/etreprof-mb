<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Search;

use Log;

use Mail;

class DesindexerContenu
{
    /**
     * Handle the event.
     *
     * @param  ContenuPublieEvent | ContenuModifieEvent | ContenuSupprime $event
     * @return void
     */
    public function handle($event)
    {
        $contenu = $event->contenu;

        $search = new Search();

		if ($search->existsContenu($contenu->id))
		{
			$search->supprimerContenu($contenu->id);
			Log::api('Search:delete:contenu', ['id' => $contenu->id]);
		}


    }
}
