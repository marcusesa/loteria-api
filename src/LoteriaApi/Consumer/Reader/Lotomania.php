<?php

namespace LoteriaApi\Consumer\Reader;

use \DOMDocument;

class Lotomania implements IReader
{
    private $domdocument;
    
    public function setDOMDocument(DOMDocument $domdocument)
    {
        $this->domdocument = $domdocument;
        return $this;
    }
    
    public function getData()
    {
        $data = [];
        
        $table = $this->domdocument->getElementsByTagName('table')->item(0);
        $trs = $table->getElementsByTagName('tr');

        for ($concursoHtml = 1; $concursoHtml < $trs->length; $concursoHtml++) {
            $tds = $trs->item($concursoHtml)->getElementsByTagName('td');
            
            $nrconcurso = $tds->item(0)->nodeValue;

            $data[$nrconcurso] = [
                'data' => $tds->item(1)->nodeValue,
                'dezenas' => [
                    0 => $tds->item(2)->nodeValue,
                    1 => $tds->item(3)->nodeValue,
                    2 => $tds->item(4)->nodeValue,
                    3 => $tds->item(5)->nodeValue,
                    4 => $tds->item(6)->nodeValue,
                    5 => $tds->item(7)->nodeValue,
                    6 => $tds->item(8)->nodeValue,
                    7 => $tds->item(9)->nodeValue,
                    8 => $tds->item(10)->nodeValue,
                    9 => $tds->item(11)->nodeValue,
                    10 => $tds->item(12)->nodeValue,
                    11 => $tds->item(13)->nodeValue,
                    12 => $tds->item(14)->nodeValue,
                    13 => $tds->item(15)->nodeValue,
                    14 => $tds->item(16)->nodeValue,
                    15 => $tds->item(17)->nodeValue,
                    16 => $tds->item(18)->nodeValue,
                    17 => $tds->item(19)->nodeValue,
                    18 => $tds->item(20)->nodeValue,
                    19 => $tds->item(21)->nodeValue,
                ],
                'arrecadacao' => $tds->item(22)->nodeValue,
                'total_ganhadores' => $tds->item(23)->nodeValue,
                'acumulado' => $tds->item(23)->nodeValue === '0' ? 'SIM' : 'NÃO',
                'valor_acumulado' => $tds->item(35)->nodeValue,
            ];
        }
        return $data;
    }
}
