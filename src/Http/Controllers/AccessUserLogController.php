<?php
/**
 * Created by PhpStorm.
 * User=> zoy
 * Date=> 04/11/16
 * Time=> 21=>39
 */

namespace Zoy\Accessuser\Http\Controllers;


use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Zoy\Accessuser\Bases\Consolidates;


class AccessUserLogController extends Controller
{

    protected  $consolidates;

    public function __construct(Consolidates $const)
    {
        $this->consolidates = $const;
    }

    public function index()
    {
        $fields = $this->consolidates->getFieldsJson();
        $template = empty($fields) ?  "blank" :  "index";
        return view('accessuser::'.$template)
            ->with('fields',$fields)
            ->with('h1',"Access");
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        $table = empty($request->has('table'))  ? 'Access' : $request->get('table') ;
        $this->consolidates->setTable($table);
        //dd($request);
        $columns = $this->consolidates->fillFields();
        $paginate = $this->consolidates->showTable($columns,$request->get('sort') , $request->get('filter') ,$request->get('per_page'));
        return response()->json($paginate)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }

    public function cols(Request $request){
        $table = empty($request->has('table'))  ? 'Access' : $request->get('table') ;
        $this->consolidates->setTable($table);
        return response()->json($this->consolidates->getFields())
             ->header('Access-Control-Allow-Origin', '*')
             ->header('Access-Control-Allow-Methods', 'GET');
    }
}