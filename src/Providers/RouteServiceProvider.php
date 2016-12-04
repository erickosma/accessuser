<?php

/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 20/11/16
 * Time: 12:14
 */

namespace Zoy\Accessuser\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Zoy\Accessuser\Http\Routes\AccessUserLogRoute;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanedev\LogViewer\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get Route attributes
     *
     * @return array
     */
    public function routeAttributes()
    {
        return array_merge($this->config('attributes', []), [
            'namespace' => 'Zoy\\Accessuser\\Http\\Controllers',
        ]);
    }

    /**
     * Check if routes is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->config('enabled', false);
    }

    /**
     * Get config value by key
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    private function config($key, $default = null)
    {
        /** @var \Illuminate\Config\Repository $config */
        $config = $this->app['config'];

        return $config->get('accessuser.route.' . $key, $default);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     */
    public function map(Router $router)
    {
        if ($this->isEnabled()) {
            $router->group($this->routeAttributes(), function(Router $router) {
                AccessUserLogRoute::register($router);
            });
        }
    }
}
