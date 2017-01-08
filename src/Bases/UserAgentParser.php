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

class UserAgentParser extends  Agent
{

    public $parser;
    public $operatingSystem;
    public $device;
    public $originalUserAgent;
    public $broweser;


    public function boot(){
        //var name of agent
        $this->originalUserAgent  = $this->getUserAgent();
        $this->broweser =  new  Broweser();
        $this->device =  new Device();
    }

    public  function dataBroweser(){
        if(empty($this->broweser)){
            $this->broweser =  new  Broweser();
        }
        return $this->broweser->detectBroewser();
    }


    public function dataDevice(){
        if(empty($this->device)){
            $this->device =  new Device();
        }
        return $this->device->detectDevice();
    }
    protected function dataOs(){}
}