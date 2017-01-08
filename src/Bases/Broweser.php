<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 07/01/17
 * Time: 15:11
 */

namespace Zoy\Accessuser\Bases;

use Jenssegers\Agent\Agent;
use UAParser\Parser;

class Broweser extends Agent
{

    /**
     *
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var array
     */
    public $data;


    public function boot()
    {
        //var name of agent
        $browser = $this->browser();
        $version = $this->version($browser);
        $this->data['name'] = $browser;
        $this->data['version'] = $version;
        $this->setName($this->data['name']);
        $this->setVersion($this->data['version']);

    }

    /**
     * @return mixed
     */
    public function detectBroewser()
    {
        if (empty($this->data)) {
            $this->boot();
        }
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        if (empty($this->name)) {
            $this->boot();
        }
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }
}