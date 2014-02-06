<?php

namespace LoteriaApi\Consumer\Reader;

use \DOMDocument;
use \DOMNodeList;

abstract class AbstractReaderHtmlLoteria implements IReaderHtml
{
    protected $domdocument;
    protected $numbersNode;
    protected $data = [];

    abstract public function getData();

    public function setDOMDocument(DOMDocument $domdocument)
    {
        $this->domdocument = $domdocument;
        return $this;
    }

    public function setNumbersNode(LoteriaNumbersNode $numbersNode)
    {
        $this->numbersNode = $numbersNode;
        return $this;
    }

    protected function loadData(LoteriaNumbersNode $numbersNode)
    {
        $table = $this->domdocument->getElementsByTagName('table')->item(0);
        $trs = $table->getElementsByTagName('tr');

        for ($concursoHtml = 1; $concursoHtml < $trs->length; $concursoHtml++) {
            $tds = $trs->item($concursoHtml)->getElementsByTagName('td');
            
            $nrconcurso = $tds->item($numbersNode->getNumberConcurso())->nodeValue;

            $data = $tds->item($numbersNode->getDataConcurso())->nodeValue;
            $dezenas = $this->loadDezenas($numbersNode, $tds);
            $arrecadacao = $tds->item($numbersNode->getArrecadacaoConcurso())->nodeValue;
            $totalGanhadores = $tds->item($numbersNode->getTotalGanhadoresConcurso())->nodeValue;
            $acumulado = $tds->item($numbersNode->getTotalGanhadoresConcurso())->nodeValue === '0' ? 'SIM' : 'NÃO';
            $valorAcumulado = $tds->item($numbersNode->getValorAcumuladoConcurso())->nodeValue;

            $this->data[$nrconcurso] = [
                'data' => $data,
                'dezenas' => $dezenas,
                'arrecadacao' => $arrecadacao,
                'total_ganhadores' => $totalGanhadores,
                'acumulado' => $acumulado,
                'valor_acumulado' => $valorAcumulado,
            ];
        }
    }

    private function loadDezenas(LoteriaNumbersNode $numbersNode, DOMNodeList $tds)
    {
        $dezenas = [];

        foreach ($numbersNode->getDezenasConcurso() as $dezenaConcurso) {
            $dezenas[] = $tds->item($dezenaConcurso)->nodeValue;
        }

        return $dezenas;
    }
}
