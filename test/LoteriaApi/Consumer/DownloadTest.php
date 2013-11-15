<?php

namespace LoteriaApi\Consumer;

use \Kodify\DownloaderBundle\Service\Downloader;

class DownloadTest extends \PHPUnit_Framework_TestCase {
    private $download;
    
    public function testDownloadClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Consumer\Download'),
                'Class not found: '.$class
        );
    }
    
    public function setUp() {
        $this->download = new Download();
    }
    
    public function testSetComponentShouldReturnInstanceOfDownload() {
        $instance = $this->download->setComponent(new Downloader);
        $this->assertInstanceOf('LoteriaApi\Consumer\Download', $instance);
    }
    
    public function testSetDataSourceShouldReturnInstanceOfDownload() {
        $instance = $this->download->setDataSource([]);
        $this->assertInstanceOf('LoteriaApi\Consumer\Download', $instance);
    }
    
    public function testSetLocalStorageShouldReturnInstanceOfDownload() {
        $instance = $this->download->setLocalStorage('test');
        $this->assertInstanceOf('LoteriaApi\Consumer\Download', $instance);
    }
    
    public function testRunShouldDownloadFiles() {
        $config = $this->getMock('\LoteriaApi\Config', ['getData']);
        $config->expects($this->any())
            ->method('getData')
           ->will($this->returnValue([
            'megasena' => [
                'name' => 'Mega-Sena',
                'url' => 'http://www1.caixa.gov.br/loterias/_arquivos/loterias/D_megase.zip',
                'zip' => 'megasena.zip'
            ]
        ]));

        $datasources = $config->getData();

        $config = $this->getMock('\LoteriaApi\Config', ['getData']);
        $config->expects($this->any())
            ->method('getData')
           ->will($this->returnValue([
            'path' => [
                'zip' => API_PATH . 'var' . DS . '_test' . DS . 'zip' . DS
            ]
        ]));

        $paths = $config->getData();
        
        $this->download
            ->setComponent(new Downloader)
            ->setDataSource($datasources)
            ->setLocalStorage($paths['path']['zip'])    
            ->run();
        
        $file = $paths['path']['zip'].$datasources['megasena']['zip'];
        $this->assertFileExists($file);
        unlink($file);
    }
}