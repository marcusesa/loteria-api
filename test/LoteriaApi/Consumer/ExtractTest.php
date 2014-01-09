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
    
    public function testSetPathsStorageShouldReturnInstanceOfExtract() {
        $instance = $this->extract->setPathsStorage('test');
        $this->assertInstanceOf('LoteriaApi\Consumer\Extract', $instance);
    }
    
    public function testRunShouldExtractFilesOfMegasena(){
        $datasources = [
            'megasena' => [
                'name' => 'Mega-Sena',
                'zip' => 'test_megasena.zip',
                'html' => 'D_MEGA.HTM',
                'gif' => 'T2.GIF',
            ]
        ];

        $paths = [
            'path' => [
                'zip' => API_PATH . 'var' . DS . '_test' . DS . 'zip' . DS,
                'ext' => API_PATH . 'var' . DS . '_test' . DS . 'ext' . DS,
            ]
        ];
        
        $this->extract
            ->setComponent(new Unzip)
            ->setDataSource($datasources)
            ->setPathsStorage($paths)    
            ->run();
        
        $html = $paths['path']['ext'].$datasources['megasena']['html'];
        $this->assertFileExists($html);        
        
        unlink($html);
        $gif = $paths['path']['ext'].$datasources['megasena']['gif'];
        unlink($gif);
    }

    public function testRunShouldExtractFilesOfLotofacil(){
        $datasources = [
            'lotofacil' => [
                'name' => 'Lotofácil',
                'zip' => 'test_lotofacil.zip',
                'html' => 'D_LOTFAC.HTM',
                'gif' => 'LOTFACIL.GIF',
            ]
        ];

        $paths = [
            'path' => [
                'zip' => API_PATH . 'var' . DS . '_test' . DS . 'zip' . DS,
                'ext' => API_PATH . 'var' . DS . '_test' . DS . 'ext' . DS,
            ]
        ];
        
        $this->extract
            ->setComponent(new Unzip)
            ->setDataSource($datasources)
            ->setPathsStorage($paths)    
            ->run();
        
        $html = $paths['path']['ext'].$datasources['lotofacil']['html'];
        $this->assertFileExists($html);        
        
        unlink($html);
        $gif = $paths['path']['ext'].$datasources['lotofacil']['gif'];
        unlink($gif);
    }

}
