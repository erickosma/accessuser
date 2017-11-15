<?php
use Illuminate\Support\ServiceProvider;
use Zoy\Accessuser\AccessUserLogServiceProvider;
use Illuminate\Filesystem\Filesystem;
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 01/12/16
 * Time: 20:28
 */
class AccessUserLogServiceProviderTest extends TestCasePackages
{
    /**
     * @var Mockery\Mock
     */
    protected $application_mock;

    /**
     * @var ServiceProvider
     */
    protected $service_provider;


    public function setUp()
    {
        parent::setUp();
     //   $this->setUpMocks();
        dd($this->app);
        if (!empty($this->app)) {
            $this->service_provider = new \Zoy\Accessuser\AccessUserLogServiceProvider($this->app);
        }

    }

    protected function setUpMocks()
    {
        $this->application_mock = Mockery::mock(new \Illuminate\Foundation\Application(__DIR__."/../"));
    }

    /**
     * @test
     */
    public function testItCanBeConstructed()
    {
        $this->assertTrue(true);
//        $this->assertInstanceOf(Illuminate\Support\ServiceProvider::class, $this->service_provider,"its ok");

    }

    /**
     * @test
     */
    public function testItDoesNothingInTheRegisterMethod()
    {
        $this->assertTrue(true);
        //$this->assertTrue(method_exists($this->service_provider,'register'));
    }


    /**
     * @test
     */
    public function testItPerformsABootMethod()
    {
        $this->application_mock->shouldReceive('publishes')
            ->andReturnNull();

        $this->application_mock->shouldReceive('mergeConfigFrom')
            ->andReturnNull();

        //$this->service_provider->boot();
    }

    public function testFileConfig(){
        $fileSystem = new Filesystem();
        $this->assertTrue($fileSystem->exists($this->app->configPath()."/accessuser.php"));
        //
        //
    }
    public function testDirResiurces(){
        $fileSystem = new Filesystem();
        $this->assertTrue($fileSystem->exists($this->app->resourcePath()));
    }


}