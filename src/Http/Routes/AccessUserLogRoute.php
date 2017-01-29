<?php
namespace Zoy\Accessuser\Http\Routes;

use Zoy\Accessuser\Http\Routes\RouteRegister;
use Illuminate\Contracts\Routing\Registrar as Router;


/**
 * Class     LogViewerRoute
 *
 * @package  Arcanedev\LogViewer\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @codeCoverageIgnore
 */
class AccessUserLogRoute extends RouteRegister
{
    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Map all routes.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Router $router)
    {
        $this->get('/', [
            'as' => 'accessuserlog::index',
            'uses' => 'AccessUserLogController@index',
        ]);
        $this->get('/show', [
            'as' => 'accessuserlog::show',
            'uses' => 'AccessUserLogController@show',
        ]);
        $this->get('/cols', [
            'as' => 'accessuserlog::cols',
            'uses' => 'AccessUserLogController@cols',
        ]);

    }


}
