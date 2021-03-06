<?php
use Illuminate\Filesystem\Filesystem;
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 03/12/16
 * Time: 07:52
 */
class ViewAndControllerTest extends TestCasePackages
{


    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testConfigAccessLogRoute()
    {
        $fileSystem = new Filesystem;
        $config  = $fileSystem->getRequire($this->app->configPath()."/accessuser.php");
        $this->assertArrayHasKey('database',$config);
        $this->assertArrayHasKey('route',$config);
    }

    /**
     *
     */
    public function testVisiteAccessLogRoute()
    {
        $fileSystem = new Filesystem;
        $config  = $fileSystem->getRequire($this->app->configPath()."/accessuser.php");
        $routeController =$config['route']['attributes']['prefix'];
        $this->assertStringStartsWith('access',$routeController);
    }
}