<?php

namespace LoteriaApi\Consumer;

use Kodify\DownloaderBundle\Service\Downloader;

class Download {
    private $component;
    private $config;
    private $pathFiles;
    
    public function __construct() {
        $this->pathFiles = API_PATH.DS.'var'.DS.'zip'.DS;
    }

    public function setComponent(Downloader $component){
        $this->component = $component;
        return $this;
    }
    
    public function setConfig(array $config) {
        $this->config = $config;
        return $this;
    }
    
    public function run() {
        foreach ($this->config as $concurso) {
            $this->component->downloadFile(
                    $concurso['url'], 
                    $this->pathFiles, 
                    $concurso['zip']
            );
        }
    }
}