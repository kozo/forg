<?php

namespace Shield\Providers;

use Illuminate\Support\ServiceProvider;
use Shield\View\Components\Text;

class ShieldServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'shield');
        $this->loadViewComponentsAs('shield', [
            Text::class
        ]);//*/
        //Blade::component('shield-text', Text::class);
    }
}
