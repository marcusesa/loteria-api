<?php

namespace LoteriaApi\Provider\Services;

use Silex\Application;

class FactoryServiceProviderTest extends \PHPUnit_Framework_TestCase {
    private $factoryServiceProvider;
    
    public function testFactoryServiceProviderClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Provider\Services\FactoryServiceProvider'),
                'Class not found: '.$class
        );
    }
    
    public function setUp() {
        $this->factoryServiceProvider = new FactoryServiceProvider();
    }
    
    public function testRegisterShouldReturnAContainerWithFactory() {
        $app = new Application();

        $app['config.datasources'] = $this->getMock('\LoteriaApi\Config');
        $app['config.path'] = $this->getMock('\LoteriaApi\Config');

        $this->factoryServiceProvider->register($app);
        $this->assertInstanceOf('LoteriaApi\Provider\Factory', $app['factory']);
    }
}
