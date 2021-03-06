<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Broadcast::routes();
        /*$this->app['router']->group($attributes, function ($router) {
            $router->post('/pusher 
                /auth', BroadcastController::class.'@authenticate');
        });*/
        /*
         * Authenticate the user's personal channel...
         */
        Broadcast::channel('App.User.*', function ($user, $userId) {
            return (int) $user->id === (int) $userId;
        });

        Broadcast::channel('discussion.*', function ($user, $userId) {
            return (int) $user->id === (int) $userId;
        });
    }
}
