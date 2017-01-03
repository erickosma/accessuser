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
use Zoy\Accessuser\Bases\Repository\TrackerManagerRepository;
use Illuminate\Cookie\CookieJar;
use Ramsey\Uuid\Uuid as UUID;


class Tracker
{

    private $cookieName ="cookie_access_user";
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
        return $this->getConfig('enabled',false) && !$this->isCommandLineInterface();
    }

    protected function isCommandLineInterface()
    {
        return (php_sapi_name() === 'cli');
    }

    public function track()
    {
        $this->configureTrackeRepository();
        $this->trackerManagerRepository->createAcess();
    }


    protected function configureTrackeRepository(){
        $this->trackerManagerRepository->setSession($this->laravel['auth']->guard());
        $dataAcess=  $this->meckeAcessUser();
        $this->trackerManagerRepository->setArrayAcess($dataAcess);
    }


    protected function meckeAcessUser(){
        return [
            'client_ip' => $this->request->getClientIp(),
            'uuid' => $this->getUuid()
        ];
    }
    protected function getUuid()
    {
        $cookie = !empty($this->laravel['cookie'])  ? $this->laravel['cookie'] : null;
        $uuid = $this->request->cookie($this->cookieName);
        if ($cookie && empty($uuid)){
            $uuid = (string) UUID::uuid4();
            $cookie->queue($this->cookieName, $uuid,10000);
        }
        return $uuid;
    }





    /**
     * Get the tracker config.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    protected function getConfig($key, $default = null)
    {
        return  $this->config->get("accessuser.$key", $default);
    }
}