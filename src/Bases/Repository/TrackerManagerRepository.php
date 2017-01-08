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

    /**
     * TrackerManagerRepository constructor.
     * @param AccessRepository|RepositoryInterface $accessRepository
     * @param $userAgentParser
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
     * @param $session
     */
    public function setSession($session)
    {
        $this->accessRepository->setSession($session);
    }


    /**
     * Create access
     * Save in DB
     *
     * return TYPE_NAME $modelAcess
     */
    public function createAccess()
    {
        $modelAccess = $this->accessRepository->findOrCreate($this->getDataAcess(), ['id', 'uuid', 'client_ip']);
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
        /* set  Zoy\Accessuser\Models\AccessAgents */
        $this->modelDevice();
        if (empty($this->userAgentParser->device)) {
            $this->userAgentParser->boot();
        }
dd($this->getDeviceArray());
        $attr = ['access_id', 'name', 'browser', 'browser_version'];
        return $this->accessRepository->findOrCreate($this->getDeviceArray(), $attr);
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
    public function modelDevice()
    {
        $this->setModel(AccessDevices::class);
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
}