<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 20/12/16
 * Time: 21:43
 */

namespace Zoy\Accessuser\Bases\Repository;


use Illuminate\Support\Facades\DB;
use Zoy\Accessuser\Bases\Repository\Eloquent\Repository;


abstract  class BaseRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public  function model(){
        return null;
    }

    /**
     * Find or create acess
     *
     * @param $data
     * @param array $attr
     * @return mixed
     */
    public function findOrCreate($data,array $attr= ['*']){
        $collectData  = $this->findWhere($data,$attr);
        if($collectData->isEmpty()){
             $model =  $this->create($data);
        }
        else{
            $model = $collectData->first();
            $model->touch();
        }
        return $model;
    }

}