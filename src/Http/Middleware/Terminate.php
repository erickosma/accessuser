<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 08/01/17
 * Time: 18:13
 */


namespace Zoy\Accessuser\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Storage;


class Terminate
{


    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }


    /**
     * @param $request
     * @param $response
     */
    public function terminate($request, $response)
    {
        if (config()->get('accessuser.enabled')) {
            $fim = app('accessuser')->trackShutDown();
            Storage::disk('local')->put('trackShutDown.txt', $fim);
        }

        // Do your profiling here
    }
}
