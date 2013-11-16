<?php

namespace LoteriaApi\Consumer\Reader;

use \DOMDocument;

class Megasena implements IReader {
    private $domdocument;
    
    public function setDOMDocument(DOMDocument $domdocument){
        $this->domdocument = $domdocument;
        return $this;
    }
    
    public function getData(){
        $data = [];
        
        $table = $this->domdocument->getElementsByTagName('table')->item(0);
        $trs = $table->getElementsByTagName('tr');

        for ($concursoHtml = 1; $concursoHtml < $trs->length; $concursoHtml++) {
            $tds = $trs->item($concursoHtml)->getElementsByTagName('td');

            $data[$tds->item(0)->nodeValue] = [
                'data' => $tds->item(1)->nodeValue,
                'dezenas' => [
                    0 => $tds->item(2)->nodeValue,
                    1 => $tds->item(3)->nodeValue,
                    2 => $tds->item(4)->nodeValue,
                    3 => $tds->item(5)->nodeValue,
                    4 => $tds->item(6)->nodeValue,
                    5 => $tds->item(7)->nodeValue,
                ],
                'arrecadacao' => $tds->item(8)->nodeValue,
                'total_ganhadores' => $tds->item(9)->nodeValue,
                'acumulado' => $tds->item(15)->nodeValue,
                'valor_acumulado' => $tds->item(16)->nodeValue,
            ];
        }            
        return $data;
    }
}
