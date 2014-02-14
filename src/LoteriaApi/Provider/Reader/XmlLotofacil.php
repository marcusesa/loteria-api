<?php

namespace LoteriaApi\Provider\Reader;

class XmlLotofacil extends AbstractXmlLoteria
{
    protected function putFileName(){
        $filename = $this->configDatasource->getData()['lotofacil']['xml'];
        $path = $this->configPath->getData()['path']['xml'];
        $this->filename = $path . $filename;    
    }
}
