<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Collection;
use Zoy\Accessuser\Models\Access;

/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 03/12/16
 * Time: 07:52
 */
class DatabaseTest extends TestCasePackages
{

    use DatabaseMigrations;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testSaveAcess()
    {
        $repository = $this->mock(Access::class);
        $repository->shouldReceive('all')
            ->andReturn(new Collection(array(new Access, new Access)));

    }

    public function testResults()
    {
        $access = new Access();
        $access->uuid = \Faker\Provider\Uuid::uuid();
        $access->client_ip = \Faker\Provider\Internet::localIpv4();
        $result = $access->save();
        $this->assertTrue($result,"Save success");

        $mockAccess = $this->mock(Access::class);
        $mockAccess->shouldReceive('find')
            ->with(1)
            ->andReturn(Access::class);
        $this->assertEquals($mockAccess->mockery_getExpectationCount(),1,"Return ressult");
    }

    public function testConfigureTrack(){
        $this->getApp()->configureTrackeRepository();
        $dataAcess = $this->getApp()->getDataAccessUser();
        $dataDomain = $this->getApp()->getDataDomain();
        $this->assertArrayHasKey('client_ip',$dataAcess);
        $this->assertArrayHasKey('uuid',$dataAcess);
        $this->assertArrayHasKey('url',$dataDomain);
        $this->assertArrayHasKey('host',$dataDomain);
    }

    public function testTrack(){
        $this->getApp()->configureTrackeRepository();
        $result = $this->getApp()->track();
        $this->assertTrue($result);
    }

    public function testTrackShutDown(){
        $this->getApp()->configureTrackeRepository();
        $this->getApp()->track();
        $result = $this->getApp()->trackShutDown();
        $this->assertTrue($result);
    }

}