<?php

namespace LoteriaApi\Consumer\Reader;

class Quina extends AbstractReaderHtmlLoteria
{
    public function getData()
    {
        $this->numbersNode->setNumberConcurso(0)
            ->setDataConcurso(1)
            ->setDezenasConcurso([2, 3, 4, 5, 6])
            ->setArrecadacaoConcurso(7)
            ->setTotalGanhadoresConcurso(8)
            ->setValorAcumuladoConcurso(15);

        parent::loadData($this->numbersNode);

        return $this->data;
    }
}
