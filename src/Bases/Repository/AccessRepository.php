<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 18/12/16
 * Time: 14:49
 */

namespace Zoy\Accessuser\Bases\Repository;


use Zoy\Accessuser\Bases\Repository\BaseRepository;


class AccessRepository extends BaseRepository
{


    /**
     * @return string
     */
    public function model() {
        return \Zoy\Accessuser\Models\Access::class;
    }



}