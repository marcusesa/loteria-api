<?php

namespace LoteriaApi\Consumer\Reader;

use \DOMDocument;

abstract class AbstractLoteria implements IReader
{
	protected $domdocument;

    public function setDOMDocument(DOMDocument $domdocument)
    {
        $this->domdocument = $domdocument;
        return $this;
    }

    abstract public function getData();
}
