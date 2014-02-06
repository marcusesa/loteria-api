<?php

namespace LoteriaApi\Consumer\Reader;

use \DOMDocument;

interface IReaderHtml
{
    public function setDOMDocument(DOMDocument $domdocument);
    public function getData();
}
