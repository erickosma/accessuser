<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 17/12/16
 * Time: 18:08
 */

namespace Zoy\Accessuser\Bases;


use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application as Laravel;
use Illuminate\Http\Request;
use Illuminate\Log\Writer as Logger;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;
use Zoy\Accessuser\Bases\Repository\TrackerManagerRepository;
use Ramsey\Uuid\Uuid as UUID;


class Tracker
{

    private $cookieName = "cookie_access_user";
    /**
     * @var \Illuminate\Routing\Router
     */
    protected $route;
    protected $logger;
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $laravel;
    protected $enabled = true;
    protected $sessionData;
    protected $config;
    protected $trackerManagerRepository;


    /**
     * Tracker constructor.
     * @param Repository $config
     * @param TrackerManagerRepository $reposTracker
     * @param Request $request
     * @param Router $route
     * @param Logger $logger
     * @param Laravel $laravel
     */
    public function __construct(
        Repository $config,
        TrackerManagerRepository $reposTracker,
        Request $request,
        Router $route,
        Logger $logger,
        Laravel $laravel)
    {
        $this->config = $config;
        $this->trackerManagerRepository = $reposTracker;
        $this->request = $request;
        $this->route = $route;
        $this->logger = $logger;
        $this->laravel = $laravel;

    }


    /**
     * Start track
     */
    public function boot()
    {
        if ($this->isTrackable()) {
            $this->track();
        }
    }

    /**
     * @return bool
     */
    protected function isTrackable()
    {
        return $this->getConfig('enabled', false) && !$this->isCommandLineInterface();
    }

    /**
     * @return bool
     */
    protected function isCommandLineInterface()
    {
        return (php_sapi_name() === 'cli');
    }

    /**
     * Create acess
     *
     */
    public function track()
    {
        try {
            $this->configureTrackeRepository();
            $this->trackerManagerRepository->createAccess();
            $this->trackerManagerRepository->createAgent();
            $this->trackerManagerRepository->createDevice();
            $this->trackerManagerRepository->createDomain();
            return true;
        } catch (Exception $exception) {
            Log::error($exception);
            return false;
        }
    }

    /**
     * Create acess route whem shut down
     *
     */
    public function trackShutDown()
    {
        try{
            if($this->trackerManagerRepository->getCheckConfig() == true){
                $this->trackerManagerRepository->createUser();
                $dataRoute = $this->getDataRoute();
                $this->trackerManagerRepository->setDataRoute($dataRoute);
                $this->trackerManagerRepository->createRoute();
                $this->trackerManagerRepository->createEventUser();
                return true;
            }
        }catch (Exception $exception) {
            Log::error($exception);
            return false;
        }

    }


    /**
     * Configuration startup access
     */
    public function configureTrackeRepository()
    {
        $this->trackerManagerRepository->checkTableExist();
        if($this->trackerManagerRepository->getCheckConfig() == false){
             throw new Exception("Table accesses not exist .Run migrate command");
        }
        //dd(auth()->user());
        $this->trackerManagerRepository->setSession($this->laravel['auth']);
        $dataAcess = $this->getDataAccessUser();
        $dataDomain = $this->getDataDomain();
        $this->trackerManagerRepository->setArrayAcess($dataAcess);
        $this->trackerManagerRepository->setDataDomain($dataDomain);
    }


    /**
     * @return array
     */
    public function getDataAccessUser()
    {
        return [
            'client_ip' => $this->request->getClientIp(),
            'uuid' => $this->getUuid()
        ];
    }


    /**
     * @return array
     */
    public function getDataDomain()
    {
        return [
            'url' => $this->request->url(),
            'host' => $this->request->getHost(),
            'search_terms_hash' => $this->request->getQueryString()
        ];
    }

    /**
     * Create or get Uuid
     * Geat from cookie
     *
     * @return array|string
     */
    protected function getUuid()
    {
        $cookie = !empty($this->laravel['cookie']) ? $this->laravel['cookie'] : null;
        $uuid = $this->request->cookie($this->cookieName);
        if ($cookie && empty($uuid)) {
            $uuid = (string)UUID::uuid4();
            $cookie->queue($this->cookieName, $uuid, 60*24*7); //1 semana
        }
        return $uuid;
    }


    /**
     * @return array
     */
    public function getDataRoute()
    {
        $this->route = $this->request->route();
        $time  = 0;
        if (defined('LARAVEL_START') && constant('LARAVEL_START') > 0) {
            $time  = microtime(true) - LARAVEL_START;
        }
        try {
            if (empty($this->route)) {
                throw new Exception("Route is null NotFoundHttpException ");
            }
            $action = $this->route->getAction();
            $controller = (isset($action['controller'])) ? class_basename($action['controller']) : "IndexController@index";
            list($controller, $action) = explode('@', $controller);
            $name = $this->route->getName();
            $uri = $this->route->uri();
            $idEvent = $this->route->parameter('id');
            $pathOrUri = $uri;
            $isAjax =  $this->request->ajax();
            return [
                'controller' => $controller,
                'action' => $action,
                'name' => $name,
                'path' => $pathOrUri,
                'is_ajax' => $isAjax,
                'time' => $time,
                'idEvent' => $idEvent
            ];
        } catch (Exception $ex) {
            Log::error($ex->getMessage());

            return [
                'controller' => "ErrorController",
                'action' => 'index',
                'name' => 'error',
                'path' => $ex->getMessage(),
                'is_ajax' => false,
                'time' => $time,
                'idEvent' => null
            ];
        }
    }


    /**
     * Get the tracker config.
     *
     * @param  string $key
     * @param  mixed|null $default
     *
     * @return mixed
     */
    protected function getConfig($key, $default = null)
    {
        return $this->config->get("accessuser.$key", $default);
    }

}