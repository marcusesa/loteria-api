<?php

namespace LoteriaApi\Consumer\Reader;

class Quina extends AbstractLoteria
{
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
                ],
                'arrecadacao' => $tds->item(7)->nodeValue,
                'total_ganhadores' => $tds->item(8)->nodeValue,
                'acumulado' => $tds->item(14)->nodeValue,
                'valor_acumulado' => $tds->item(15)->nodeValue,
            ];
        }
        return $data;
    }
}
