<?php

namespace LoteriaApi\Consumer;

use \Kodify\DownloaderBundle\Service\Downloader;
use \LoteriaApi\Config;

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
        $config = (new Config)
            ->setApiPath(API_PATH)
            ->setDirectory('etc')
            ->setExt('ini');

        $paths = $config
            ->setFileName('path')
            ->getData();
        
        $datasources = $config
            ->setFileName('datasource')
            ->getData();
        
        $this->download
            ->setComponent(new Downloader)
            ->setDataSource($datasources)
            ->setLocalStorage($paths['path']['zip'])    
            ->run();
        
        $this->assertFileExists($paths['path']['zip'].'megasena.zip');
    }
}