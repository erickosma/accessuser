<?php

use Illuminate\Filesystem\ClassFinder;
use Illuminate\Filesystem\Filesystem;


abstract class TestCasePackages extends Orchestra\Testbench\TestCase
{
    public $app;
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $pathApp = __DIR__ . '/../../../../bootstrap/app.php';
        $this->app = require $pathApp;
        $this->app->register('Zoy\Accessuser\AccessUserLogServiceProvider');

        //$this->app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $this->app;
    }

    /**
     * Setup DB before each test.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->migrateUp();
    }

    /**
     * run package database migrations
     *
     * @return void
     */
    public function migrateUp()
    {
        $this->migrate('up');
        /* $this->artisan('migrate', [
             '--database' => 'testbench',
             '--realpath' => realpath(__DIR__.'/../src/migrations'),
         ]);*/
    }
    public function migrateDown(){
        $this->migrate('down');
    }

    private function migrate($calMethod)
    {
        $fileSystem = new Filesystem;
        $classFinder = new ClassFinder;
        foreach ($fileSystem->files(__DIR__ . "/../src/migrations") as $file) {
            $fileSystem->requireOnce($file);
            $migrationClass = $classFinder->findClass($file);
            (new $migrationClass)->$calMethod();
        }
    }

    protected function getPackageProviders($app)
    {
        return ['Zoy\Accessuser\AccessUserLogServiceProvider'];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        /*$app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);*/
        $this->settingConfigs($app['config']);
        $this->settingRoutes($app['router']);
    }

    /**
     * Setting the configs.
     *
     * @param  \Illuminate\Contracts\Config\Repository  $config
     */
    private function settingConfigs($config)
    {
        $config->set('laravel-tracker.enabled', true);
    }


    /**
     * Resolve application HTTP Kernel implementation.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     *
     **/
    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Http\Kernel', 'Acme\Testbench\Http\Kernel');
    }


    /**
     * Resolve application Console Kernel implementation.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     **/
    protected function resolveApplicationConsoleKernel($app)
    {
        $app->singleton('Illuminate\Contracts\Console\Kernel', 'Acme\Testbench\Console\Kernel');
    }

    protected function tearDown()
    {
        $this->migrateDown();
        parent::tearDown();
    }
}
