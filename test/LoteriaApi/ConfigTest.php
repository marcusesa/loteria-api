<?php

namespace LoteriaApi;

class ConfigTest extends \PHPUnit_Framework_TestCase {
    private $config;
    
    public function testConfigClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Config'),
                'Class not found: '.$class
        );
    }
    
    public function setUp() {
        $this->config = new Config();
    }
    
    public function testSetApiPathShouldReturnInstanceOfConfig() {
        $instance = $this->config->setApiPath(API_PATH);
        $this->assertInstanceOf('LoteriaApi\Config', $instance);
    }
    
    public function testSetDirectoryShouldReturnInstanceOfConfig() {
        $instance = $this->config->setDirectory('etc');
        $this->assertInstanceOf('LoteriaApi\Config', $instance);
    }
    
    public function testSetFileNameShouldReturnInstanceOfConfig() {
        $instance = $this->config->setFileName('datasource');
        $this->assertInstanceOf('LoteriaApi\Config', $instance);
    }
    
    public function testSetExtShouldReturnInstanceOfConfig() {
        $instance = $this->config->setExt('yml');
        $this->assertInstanceOf('LoteriaApi\Config', $instance);        
    }
}