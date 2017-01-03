<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 04/11/16
 * Time: 21:39
 */

namespace Zoy\Accessuser\Http\Controllers;


use Illuminate\Routing\Controller;
use Zoy\Accessuser\Models\Access;

class AccessUserLogController extends Controller
{

    public function index()
    {
        return view('accessuser::index');
    }

}