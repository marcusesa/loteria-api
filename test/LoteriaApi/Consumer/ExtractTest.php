<?php

namespace LoteriaApi\Consumer;

use VIPSoft\Unzip\Unzip;

class ExtractTest extends \PHPUnit_Framework_TestCase {
    private $extract;
    
    public function testExtractClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Consumer\Extract'),
                'Class not found: '.$class
        );
    }
    
    public function setUp() {
        $this->extract = new Extract();
    }
    
    public function testSetComponentShouldReturnInstanceOfExtract() {
        $instance = $this->extract->setComponent(new Unzip);
        $this->assertInstanceOf('LoteriaApi\Consumer\Extract', $instance);
    }
    
    public function testSetDataSourceShouldReturnInstanceOfExtract() {
        $instance = $this->extract->setDataSource([]);
        $this->assertInstanceOf('LoteriaApi\Consumer\Extract', $instance);
    }
    
    public function testSetPathsShouldReturnInstanceOfExtract() {
        $instance = $this->extract->setPaths('test');
        $this->assertInstanceOf('LoteriaApi\Consumer\Extract', $instance);
    }
    
    public function testRunShouldExtractFiles(){
        $config = $this->getMock('\LoteriaApi\Config', ['getData']);
        $config->expects($this->any())
            ->method('getData')
           ->will($this->returnValue([
            'megasena' => [
                'name' => 'Mega-Sena',
                'zip' => 'test_megasena.zip'
            ]
        ]));

        $datasources = $config->getData();

        $config = $this->getMock('\LoteriaApi\Config', ['getData']);
        $config->expects($this->any())
            ->method('getData')
           ->will($this->returnValue([
            'path' => [
                'zip' => API_PATH . 'var' . DS . '_test' . DS . 'zip' . DS,
                'ext' => API_PATH . 'var' . DS . '_test' . DS . 'ext' . DS,
            ]
        ]));

        $paths = $config->getData();
        
        $this->extract
            ->setComponent(new Unzip)
            ->setDataSource($datasources)
            ->setPaths($paths)    
            ->run();
        
        $file = $paths['path']['ext'].'D_MEGA.HTM';
        $this->assertFileExists($file);
        unlink($file);
    }

}
