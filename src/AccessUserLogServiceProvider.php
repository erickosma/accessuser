<?php

namespace Zoy\Accessuser;

use Illuminate\Support\ServiceProvider;
use Zoy\Accessuser\Bases\Repository\AccessRepository;
use Zoy\Accessuser\Bases\Tracker;
use Zoy\Accessuser\Bases\Repository\TrackerManagerRepository;


class AccessUserLogServiceProvider extends ServiceProvider
{

    private $tracker;

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

        if ($this->getConfig('enabled',false)) {
            if (!$this->getConfig('use_middleware')) {
                $this->bootTracker();
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->getConfig('enabled')) {
            $this->app->register(Providers\RouteServiceProvider::class);
            $this->registerRepositories();
            $this->registerTracker();
        }

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

    /**
     * Boot & Track.
     */
    private function bootTracker()
    {
        $this->getTracker()->boot();
    }


    /**
     * @return Tracker
     */
    public function getTracker()
    {
        if (!$this->tracker) {
            $this->tracker = $this->app['accessuser'];
        }
        return $this->tracker;
    }


    /**
     * Takes all the components of Tracker and glues them
     * together to create Tracker.
     *
     * @return void
     */
    private function registerTracker()
    {
        $this->app['accessuser'] = $this->app->share(function ($app) {
            $app['accessuser.loaded'] = true;
            return new Tracker(
                $this->config(),
                $app['accessuser.repositories'],
                $app['request'],
                $app['router'],
                $app['log'],
                $app
            );
        });
    }

    public function registerRepositories()
    {
       // $this->app->register(\Prettus\Repository\Providers\LumenRepositoryServiceProvider::class);
        $this->app['accessuser.repositories'] = $this->app->share(function ($app) {
            return new TrackerManagerRepository(new AccessRepository($app));
        });
    }


}
