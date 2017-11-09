<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormElementsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	Form::component('multiCheckbox', 'form.multi-checkbox', ['name', 'options', 'values', 'attributes']);
    	Form::component('radios', 'form.radios', ['name', 'options', 'value', 'attributes']);
    	//Form::component('uploader', 'form-elements.uploader', ['params', 'fichiers']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
