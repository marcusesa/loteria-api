<?php

namespace LoteriaApi\Provider\Reader;

class XmlMegasena extends AbstractXmlLoteria
{
    protected function putFileName(){
        $filename = $this->configDatasource->getData()['megasena']['xml'];
        $path = $this->configPath->getData()['path']['xml'];
        $this->filename = $path . $filename;    
    }
}
