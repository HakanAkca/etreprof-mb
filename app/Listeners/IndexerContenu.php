<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Search;

use Mail;
use Log;

class IndexerContenu
{
    /**
     * Handle the event.
     *
     * @param  ContenuPublieEvent | ContenuModifieEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $contenu = $event->contenu;

		$search = new Search();
		$search->indexerContenu($contenu);
		Log::api('Search:index:contenu', ['id' => $contenu->id]);

    }
}
