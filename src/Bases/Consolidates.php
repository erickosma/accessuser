<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 13/01/17
 * Time: 19:54
 */

namespace Zoy\Accessuser\Bases;



use Zoy\Accessuser\Bases\Repository\AccessRepository;
use Zoy\Accessuser\Models\Access;
use Zoy\Accessuser\Models\AccessAgents;
use Zoy\Accessuser\Models\AccessDevices;
use Zoy\Accessuser\Models\AccessDomains;
use Zoy\Accessuser\Models\AccessRoutes;
use Zoy\Accessuser\Models\AccessUserLog;

class Consolidates
{

    protected $fields;


    protected $repo;

    protected $table;

    public function __construct($table=false)
    {
        if($table == false){
            $table =  Access::class;
        }
        $this->repo = $this->getRepository();
        $this->repo->setModel($table);
        $this->setFields($this->repo->getFields());
    }

    /**
     *
     * @param array $columns
     * @param null $sort
     * @param null $filter
     * @param null $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function showTable($columns = [], $sort = null, $filter = null, $perPage=null){
        return $this->repo->show($columns ,$sort , $filter ,$perPage);
    }

    /**
     * @return \Zoy\Accessuser\Bases\Repository\AccessRepository
     */
    public  function getRepository(){
        if(!empty($this->repo)){
            return $this->repo;
        }

        $repo = app('accessuser.repositories')->getAccessRepository();
        if(empty($repo)){
            $prefix = Config::getConfig('database.prefix',app(),'accessuser_');
            $repo = new AccessRepository(app(),$prefix);
        }
        return $repo;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return mixed
     */
    public function getFieldsJson()
    {
       return json_encode($this->repo->getFields());
    }
    /**
     * @param mixed $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }



    public function fillFields(){
        $allowed = 'name';
        $fill=[];
        foreach ($this->getFields() as $key=> $field){
            if(array_key_exists($allowed,$field)){
                $fill[] =$field[$allowed];
            }
        }
        return $fill;
    }


    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
        $this->doModel($table);
        $this->setFields($this->repo->getFields());
    }

    /**
     * @param $table
     */
    public function doModel($table){
        switch ($table) {
            case 'Access':
                $this->modelAccess();
                break;
            case 'AccessAgents':
                $this->modelAgents();
                break;
            case 'AccessDevices':
                $this->modelDevice();
                break;
            case 'AccessDomains':
                $this->modelDomain();
                break;
            case 'AccessRoutes':
                $this->modelRoute();
                break;
            case 'AccessUserLog':
                $this->modelUserLog();
                break;
        }
    }

    public function getModel(){
       return  $this->repo->model();
    }

    /**
     * @param $eloquentModel
     */
    public function setModel($eloquentModel)
    {
        $this->repo->setModel($eloquentModel);
    }
    /**
     * Sete model agent
     */
    public function modelAccess()
    {
        $this->setModel(Access::class);
    }

    /**
     * Sete model agent
     */
    public function modelAgents()
    {
        $this->setModel(AccessAgents::class);
    }


    /**
     * Sete model agent
     */
    public function modelAgentsUser()
    {
        $this->setModel(AccessUserLog::class);
    }
    /**
     * Sete model agent
     */
    public function modelDevice()
    {
        $this->setModel(AccessDevices::class);
    }

    /**
     * Sete model agent
     */
    public function modelDomain()
    {
        $this->setModel(AccessDomains::class);
    }

    /**
     * Sete model agent
     */
    public function modelRoute()
    {
        $this->setModel(AccessRoutes::class);
    }

    public function modelUserLog()
    {
        $this->setModel(AccessUserLog::class);
    }
}