<?php

namespace LoteriaApi;

class Config {
    private $apiPath;

    public function setApiPath($apiPath) {
        $this->apiPath = $apiPath;
        return $this;
    }
}
