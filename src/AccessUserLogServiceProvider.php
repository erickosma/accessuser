<?php

namespace Zoy\Accessuser;

use Illuminate\Support\ServiceProvider;

class AccessUserLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'accessuser');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/zoy/accessuser'),
        ]);
        $this->publishes([
            __DIR__.'/migrations' => database_path('migrations/'),
        ]);
        $this->publishes([
            __DIR__ . '/config/accessuser.php' => config_path('accessuser.php'),
        ]);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(Providers\RouteServiceProvider::class);
    }


    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the config repository.
     *
     * @return \Illuminate\Contracts\Config\Repository
     */
    private function config()
    {
        return $this->app['config'];
    }

    /**
     * Get the tracker config.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    protected function getConfig($key, $default = null)
    {
        return $this->config()->get("accessuser.$key", $default);
    }



}
