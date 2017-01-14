<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 17/12/16
 * Time: 18:32
 */

namespace Zoy\Accessuser\Http\Middleware;


use Closure;

class AccessLog
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config()->get('accessuser.enabled')) {
            app('accessuser')->boot();
        }
        return $next($request);
    }

}