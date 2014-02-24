<?php

namespace LoteriaApi\Provider\Services;

use Silex\Application;

class ConfigServiceProviderTest extends \PHPUnit_Framework_TestCase {
    private $configServiceProvider;
    
    public function testConfigServiceProviderClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Provider\Services\ConfigServiceProvider'),
                'Class not found: '.$class
        );
    }
    
    public function setUp() {
        $this->configServiceProvider = new ConfigServiceProvider();
    }
    
    public function testRegisterShouldReturnAContainerWithConfigs() {
        $app = new Application();

        $app['config.api_path'] = API_PATH;
        $app['config.directory'] = 'etc';
        $app['config.ext'] = 'ini';

        $this->configServiceProvider->register($app);
        $this->assertInstanceOf('LoteriaApi\Config', $app['config']);
        $this->assertInstanceOf('LoteriaApi\Config', $app['config.datasources']);
        $this->assertInstanceOf('LoteriaApi\Config', $app['config.path']);
    }
}
