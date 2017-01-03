<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 17/12/16
 * Time: 18:18
 */

namespace Zoy\Accessuser\Bases\Repository;


class TrackerManagerRepository
{
    private $accessRepository;

    public $dataAcess;

    public $accessId;

    /**
     * TrackerManagerRepository constructor.
     * @param AccessRepository $accessRepository
     */
    public function __construct(AccessRepository $accessRepository)
    {
        $this->accessRepository = $accessRepository;
    }

    public function setSession($session){
        $this->accessRepository->setSession($session);
    }


    public function createAcess(){
         $this->accessRepository->findOrCriate($this->getDataAcess());

    }

    public function setArrayAcess(array $dataAcess =array())
    {
        $this->setDataAcess($dataAcess);
    }


    /**
     * @return mixed
     */
    public function getDataAcess()
    {
        return $this->dataAcess;
    }

    /**
     * @param mixed $dataAcess
     */
    public function setDataAcess($dataAcess)
    {
        $this->dataAcess = $dataAcess;
    }
}