<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 20/11/16
 * Time: 11:01
 * accessuser.php
 */

return [

    /* ------------------------------------------------------------------------------------------------
     |  Enabled
     | ------------------------------------------------------------------------------------------------
     */
    'enabled' => false,

    /* ------------------------------------------------------------------------------------------------
     |  Database
     | ------------------------------------------------------------------------------------------------
     */
    'database' => [
        'connection' => 'sqlite',
        'prefix' => 'accessuser_'
    ],

    'user_model' => 'Zoy\Accessuser\Model\User',

    /*
     * Deffer booting for middleware use
     * IF is  true . Add the Middleware to Laravel Kernel
     * Open the file app/Http/Kernel.php and add the following to your web middlewares:
     *  Zoy\Accessuser\Http\Middleware\AccessLog::class,
     *
     */
    'use_middleware' => false,

    /* ------------------------------------------------------------------------------------------------
      |  Route settings
      | ------------------------------------------------------------------------------------------------
      */
    'route' => [
        'enabled' => true,
        'attributes' => [
            'prefix' => 'accessuserlog',
            'middleware' => ['web'],
        ],
    ],

];