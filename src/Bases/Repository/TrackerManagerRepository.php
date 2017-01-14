<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 17/12/16
 * Time: 18:18
 */

namespace Zoy\Accessuser\Bases\Repository;


use Zoy\Accessuser\Bases\Repository\Contracts\RepositoryInterface;
use Zoy\Accessuser\Bases\UserAgentParser;
use Zoy\Accessuser\Models\AccessAgents;
use Zoy\Accessuser\Models\AccessDevices;
use Zoy\Accessuser\Models\AccessDomains;
use Zoy\Accessuser\Models\AccessRoutes;
use Illuminate\Auth\SessionGuard;
use Zoy\Accessuser\Models\AccessUserLog;

class TrackerManagerRepository
{
    /**
     * @var
     */
    public $dataAcess;

    /**
     * @var
     */
    public $accessId;
    /**
     *
     * @var AccessRepository|RepositoryInterface
     */
    private $accessRepository;

    private $userAgentParser;

    protected $prefix;

    protected $dataDomain;

    protected $dataRoute;

    private $session;


    /**
     * TrackerManagerRepository constructor.
     * @param $prefix
     * @param AccessRepository|RepositoryInterface $accessRepository
     * @param UserAgentParser $userAgentParser
     */
    public function __construct(
        $prefix,
        RepositoryInterface $accessRepository,
        UserAgentParser $userAgentParser)
    {
        $this->prefix = $prefix;
        $this->accessRepository = $accessRepository;
        $this->userAgentParser = $userAgentParser;
    }

    /**
     * @param SessionGuard|IlluminateSession $session
     * @internal param $IlluminateSession
     */
    public function setSession(SessionGuard $session)
    {
        $this->session = $session;
    }


    /**
     * @return \lluminate\Auth\SessionGuard
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Create access
     * Save in DB
     *
     * return TYPE_NAME $modelAcess
     * @param array $data
     * @return mixed
     */
    public function createAccess(array $data =[])
    {
        if(empty($data)){
            $data = $this->getDataAcess();
        }
        $modelAccess = $this->accessRepository->findOrCreate($data, ['id', 'uuid', 'client_ip']);
        $this->accessId = $modelAccess->id;
        return $modelAccess;
    }




    /**
     *
     *
     * @return mixed
     */
    public function createAgent()
    {
        /* set  Zoy\Accessuser\Models\AccessAgents */
        $this->modelAgents();
        if (empty($this->userAgentParser->broweser)) {
            $this->userAgentParser->boot();
        }
        $attr = ['access_id', 'name', 'browser', 'browser_version'];
        return $this->accessRepository->findOrCreate($this->getCurrentAgentArray(), $attr);
    }

    /**
     * @return mixed
     */
    public function createDevice()
    {
        /* set  Zoy\Accessuser\Models\AccessDevice */
        $this->modelDevice();
        if (empty($this->userAgentParser->device)) {
            $this->userAgentParser->boot();
        }
        $attr = ["access_id", "kind", "model" ,  "platform" , "platform_version" , "is_mobile" , "is_robot" ];
        return $this->accessRepository->findOrCreate($this->getDeviceArray(), $attr);
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function createDomain(array $data =[])
    {
        /* set  Zoy\Accessuser\Models\AccessDomain */
        $this->modelDomain();
        if(empty($data)){
            $data = $this->getDataDomain();
        }
        $attr = ["access_id", "url", "host" ,  "search_terms_hash"];
        return $this->accessRepository->create($data, $attr);
    }



    /**
     * @param array $data
     * @return mixed
     */
    public function createRoute(array $data =[])
    {
        /* set  Zoy\Accessuser\Models\AccessDomain */
        $this->modelRoute();
        if(empty($data)){
            $data = $this->getDataRoute();
        }
        $attr = ["access_id", "controller", "action" ,  "name",  "path"];
        return $this->accessRepository->create($data, $attr);
    }

    /**
     *
     *
     * @return bool|mixed
     */
    public function createUser()
    {
        if(!$this->session->guest() && !empty($this->session->id())){
            $this->modelAgentsUser();

            $data = $this->getDataUser();
            $modelAccess = $this->accessRepository->findOrCreate($data, ['access_id', 'user_id']);
            $this->accessId = $modelAccess->id;
            return $modelAccess;
        }
        return false;
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

    /**
     * @param $eloquentModel
     */
    public function setModel($eloquentModel)
    {
        $this->accessRepository->setModel($eloquentModel);
    }

    /**
     * @param array $dataAcess
     */
    public function setArrayAcess(array $dataAcess = array())
    {
        $this->setDataAcess($dataAcess);
    }

    /**
     * @return mixed
     */
    public function getAccessId()
    {
        return $this->accessId;
    }

    /**
     * @param mixed $accessId
     */
    public function setAccessId($accessId)
    {
        $this->accessId = $accessId;
    }

    /**
     * @return array
     */
    public function getCurrentAgentArray()
    {
        $this->userAgentParser->broweser->boot();
        return [
            'access_id' => $this->getAccessId(),
            'name' => $this->getCurrentUserAgent() ?: 'Other',
            'browser' => $this->userAgentParser->broweser->getName(),
            'browser_version' => $this->userAgentParser->broweser->getVersion(),
        ];
    }

    /**
     * @return mixed
     */
    public function getCurrentUserAgent()
    {
        return $this->userAgentParser->originalUserAgent;
    }


    public function getDeviceArray()
    {
        return array_merge(['access_id' => $this->getAccessId()],
            $this->userAgentParser->device->detectDevice());

    }
    /**
     * @return mixed
     */
    public function getDataDomain()
    {
        return array_merge( ['access_id' => $this->getAccessId()],
            $this->dataDomain);
    }

    /**
     * @param mixed $dataDomain
     */
    public function setDataDomain($dataDomain)
    {
        $this->dataDomain = $dataDomain;
    }

    /**
     * @return mixed
     */
    public function getDataRoute()
    {
        return array_merge( ['access_id' => $this->getAccessId()],
            $this->dataRoute);
    }


    /**
     * @return mixed
     */
    public function getDataUser()
    {

        return ['access_id' => $this->getAccessId(),
             'user_id' => $this->session->id()];
    }

    /**
     * @param mixed $dataRoute
     */
    public function setDataRoute($dataRoute)
    {
        $this->dataRoute = $dataRoute;
    }
}