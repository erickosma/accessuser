<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 18/12/16
 * Time: 14:49
 */

namespace Zoy\Accessuser\Bases\Repository;

use Illuminate\Auth\SessionGuard;
use Zoy\Accessuser\Models\Access;
use Zoy\Accessuser\Bases\Repository\BaseRepository;


class AccessRepository extends BaseRepository
{

    /**
     *sss
     */
    private $session;


    /**
     * @return string
     */
    public function model() {
        return \Zoy\Accessuser\Models\Access::class;
    }


    /**
     * @param SessionGuard|IlluminateSession $session
     * @internal param $IlluminateSession
     */
    public function setSession(SessionGuard $session)
    {
        $this->session = $session;
    }


}