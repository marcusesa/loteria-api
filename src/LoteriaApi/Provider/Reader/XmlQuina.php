<?php

namespace LoteriaApi\Provider\Reader;

class XmlQuina extends AbstractXmlLoteria
{
    protected function putFileName()
    {
        $filename = $this->configDatasource->getData()['quina']['xml'];
        $path = $this->configPath->getData()['path']['xml'];
        $this->filename = $path . $filename;
    }
}
