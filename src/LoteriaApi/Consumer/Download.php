<?php

namespace LoteriaApi\Consumer;

use Kodify\DownloaderBundle\Service\Downloader;

class Download
{
    private $component;
    private $datasource;
    private $localstorage;
    
    public function setComponent(Downloader $component)
    {
        $this->component = $component;
        return $this;
    }
    
    public function setDataSource(array $datasource)
    {
        $this->datasource = $datasource;
        return $this;
    }
    
    public function setLocalStorage($localstorage)
    {
        $this->localstorage = $localstorage;
        return $this;
    }

    public function run()
    {
        foreach ($this->datasource as $concurso) {
            $this->component->downloadFile(
                $concurso['url'],
                $this->localstorage,
                $concurso['zip']
            );
        }
    }
}
