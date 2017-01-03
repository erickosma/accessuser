<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 20/12/16
 * Time: 21:43
 */

namespace Zoy\Accessuser\Bases\Repository;


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

    public function findOrCriate($data){
        dd($data);
       // dd($this->findWhere($data,['id']));
        // dd($model);
    }

}