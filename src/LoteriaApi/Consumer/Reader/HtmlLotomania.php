<?php

namespace LoteriaApi\Consumer\Reader;

class HtmlLotomania extends AbstractReaderHtmlLoteria
{
    public function getData()
    {
        $this->numbersNode->setNumberConcurso(0)
            ->setDataConcurso(1)
            ->setDezenasConcurso([2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21])
            ->setArrecadacaoConcurso(22)
            ->setTotalGanhadoresConcurso(23)
            ->setValorAcumuladoConcurso(35);

        parent::loadData($this->numbersNode);

        return $this->data;
    }
}
