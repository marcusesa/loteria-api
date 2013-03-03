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
}
