<?php

namespace Asanpay\Shaparak;

use Illuminate\Support\ServiceProvider;
use Asanpay\Shaparak\Contracts\Factory;

class ShaparakServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResources();
        $this->registerPublishing();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new ShaparakManager($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Factory::class];
    }

    /**
     * Determine if the provider is deferred.
     *
     * @return bool
     */
    public function isDeferred()
    {
        return true;
    }

    protected function registerResources()
    {
        $this->publishes([
            __DIR__ . '/../translations/' => resource_path('lang/vendor/shaparak'),
        ], 'translations');

        $this->loadTranslationsFrom(__DIR__ . '/../translations', 'shaparak');
    }

    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/shaparak.php' => config_path('shaparak.php')
        ], 'config');
    }
}
