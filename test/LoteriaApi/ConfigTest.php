<?php

namespace LoteriaApi;

class ConfigTest extends \PHPUnit_Framework_TestCase {
    
    public function testConfigClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Config'),
                'Class not found: '.$class
        );
    }
    
    public function testSetApiPathShouldReturnInstanceOfConfig() {
        $instance = new Config();
        $path = API_PATH;
        $instance = $instance->setApiPath($path);
        $this->assertInstanceOf('LoteriaApi\Config', $instance);
    }
}