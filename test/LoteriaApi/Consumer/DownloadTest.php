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
    
    public function testSetConfigShouldReturnInstanceOfDownload() {
        $instance = $this->download->setConfig([]);
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
        
        $this->download
            ->setComponent(new Downloader)
            ->setConfig($config->getData())
            ->run();
        
        $this->assertFileExists(API_PATH.DS.'var'.DS.'zip'.DS.'megasena.zip');
    }
}