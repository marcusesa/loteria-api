<?php

namespace LoteriaApi\Provider\Reader;

class XmlLotomania extends AbstractXmlLoteria
{
    protected function putFileName(){
        $filename = $this->configDatasource->getData()['lotomania']['xml'];
        $path = $this->configPath->getData()['path']['xml'];
        $this->filename = $path . $filename;    
    }
}
