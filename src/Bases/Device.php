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

class Device extends Agent
{

    /**
     * Detect kind, model and mobility.
     *
     * @return array
     */
    public function detectDevice()
    {
        return [
            'kind'      => $this->getDeviceKind(),
            'model'     => $this->device(),
            'platform'  => $this->platform(),
            'platform_version'  => $this->platformVersion(),
            'is_mobile' => $this->isMobile(),
            'is_robot'  => $this->isRobot(),

        ];
    }

    public function platformVersion(){
        return $this->version($this->platform());

    }    /**
     * Get the kind of device.
     *
     * @internal param $mobile
     *
     * @return string
     */
    public function getDeviceKind()
    {
        $kind = 'unavailable';
        if ($this->isTablet()) {
            $kind = 'Tablet';
        } elseif ($this->isPhone()) {
            $kind = 'Phone';
        } elseif ($this->isComputer()) {
            $kind = 'Computer';
        }
        return $kind;
    }
    /**
     * Is this a phone?
     *
     * @return bool
     */
    public function isPhone($userAgent = null, $httpHeaders = null)
    {
        return !$this->isTablet() && !$this->isComputer();
    }
    /**
     * Is this a computer?
     *
     * @return bool
     */
    public function isComputer()
    {
        return !$this->isMobile();
    }

}