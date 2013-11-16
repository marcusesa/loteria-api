<?php

namespace LoteriaApi\Consumer\Reader;

use \DOMDocument;

interface IReader {
    public function setDOMDocument(DOMDocument $domdocument);
    public function getData();
}
