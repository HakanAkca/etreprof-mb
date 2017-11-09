<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ContenuProposeEvent' => [
            //'App\Listeners\EventListener',
        ],
        'App\Events\ContenuEvalueEvent' => [
            //'App\Listeners\EventListener',
        ],
        'App\Events\ContenuPublieEvent' => [
            'App\Listeners\IndexerContenu',
        ],
        'App\Events\ContenuModifieEvent' => [
            'App\Listeners\IndexerContenu',
        ],
        'App\Events\ContenuDepublieEvent' => [
            'App\Listeners\DesindexerContenu',
        ],
        'App\Events\ContenuSupprimeEvent' => [
            'App\Listeners\DesindexerContenu',
        ],
        'App\Events\UtilisateurInscritEvent' => [
            //'App\Listeners\Notifier\AdminNouvelUtilisateur',
        ],
        'App\Events\UtilisateurPromuTeteChercheuseEvent' => [
            'App\Listeners\Notifier\UtilisateurPromuTeteChercheuse',
        ],
        'App\Events\DemandeRechercheEvent' => [
            'App\Listeners\Notifier\AdminDemandeRecherche',
        ],
        'App\Events\UserFeedbackEvent' => [
            'App\Listeners\Notifier\AdminUserFeedback',
        ], 
        'App\Events\Discussion\NewMessageEvent' => [
            'App\Listeners\Notifier\NewMessages',
        ],
        'App\Events\ContactMessageEvent' => [
            'App\Listeners\Notifier\ContactMessage',
        ],
        'App\Events\SosMessageEvent' => [
            'App\Listeners\Notifier\SosMessage',
        ],    
        'App\Events\CommentairePublieEvent' => [
            'App\Listeners\Notifier\CommentairePublie',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
