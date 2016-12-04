<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 04/11/16
 * Time: 21:39
 */

namespace Zoy\Accessuser\Http\Controllers;


use Illuminate\Routing\Controller;

class AccessUserLogController extends Controller
{

    public function index()
    {
        return view('accessuser::index');
    }

}