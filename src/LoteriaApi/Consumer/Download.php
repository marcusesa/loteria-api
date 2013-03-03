<?php

namespace LoteriaApi\Consumer;

use Kodify\DownloaderBundle\Service\Downloader;

class Download {
    private $component;

    public function setComponent(Downloader $component){
        $this->component = $component;
        return $this;
    }
}