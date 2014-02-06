<?php

namespace LoteriaApi\Consumer;

use \DOMDocument;
use LoteriaApi\Consumer\Reader\LoteriaNumbersNode;

class Reader
{
    private $datasource;
    private $paths;

    public function setDataSource($datasource)
    {
        $this->datasource = $datasource;
        return $this;
    }
    
    public function setPathsStorage($paths)
    {
        $this->paths = $paths;
        return $this;
    }
    
    public function getData()
    {
        $data = [];
        foreach ($this->datasource as $concursoName => $concursoData) {
            $file = $this->paths['path']['ext'].$concursoData['html'];
            $doc = new DOMDocument();
            $doc->loadHTMLFile($file);
            $data[$concursoName] = (new $concursoData['reader'])
                ->setDOMDocument($doc)
                ->setNumbersNode(new LoteriaNumbersNode)
                ->getData(new LoteriaNumbersNode);
        }
        return $data;
    }
}
