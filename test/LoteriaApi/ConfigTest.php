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
    
    public function testGetDataShouldReturnAnArray(){
        $result = $this->config->setApiPath(API_PATH)
            ->setDirectory('etc')
            ->setFileName('datasource')
            ->setExt('ini')
            ->getData();
        $this->assertTrue(is_array($result));
        $this->assertEquals([
            'megasena' => [
                'name' => 'Mega-Sena',
                'url' => 'http://www1.caixa.gov.br/loterias/_arquivos/loterias/D_megase.zip',
                'zip' => 'megasena.zip'
            ]
        ], $result);
    }
 
    /**
     * @expectedException Exception
     * @expectedExceptionMessage File does not exist 
     */
    public function testGetDataShouldThrownAnException(){
        $this->config->setApiPath(API_PATH)
            ->setDirectory('etc')
            ->setFileName('noexist')
            ->setExt('ini')
            ->getData();
    }
}