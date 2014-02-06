<?php

namespace LoteriaApi\Consumer\Reader;

class LoteriaNumbersNode
{
    private $numberConcurso;
    private $dataConcurso;
    private $dezenasConcurso = [];
    private $arrecadacaoConcurso;
    private $totalGanhadoresConcurso;
    private $valorAcumuladoConcurso;

    public function setNumberConcurso($numberConcurso)
    {
        $this->numberConcurso = $numberConcurso;
        return $this;
    }

    public function setDataConcurso($dataConcurso)
    {
        $this->dataConcurso = $dataConcurso;
        return $this;
    }

    public function setDezenasConcurso(array $dezenasConcurso)
    {
        $this->dezenasConcurso = $dezenasConcurso;
        return $this;
    }

    public function setArrecadacaoConcurso($arrecadacaoConcurso)
    {
        $this->arrecadacaoConcurso = $arrecadacaoConcurso;
        return $this;
    }

    public function setTotalGanhadoresConcurso($totalGanhadores)
    {
        $this->totalGanhadoresConcurso = $totalGanhadores;
        return $this;
    }

    public function setValorAcumuladoConcurso($valorAcumulado)
    {
        $this->valorAcumuladoConcurso = $valorAcumulado;
        return $this;
    }

    public function getNumberConcurso()
    {
        return $this->numberConcurso;
    }

    public function getDataConcurso()
    {
        return $this->dataConcurso;
    }

    public function getDezenasConcurso()
    {
        return $this->dezenasConcurso;
    }

    public function getArrecadacaoConcurso()
    {
        return $this->arrecadacaoConcurso;
    }

    public function getTotalGanhadoresConcurso()
    {
        return $this->totalGanhadoresConcurso;
    }

    public function getValorAcumuladoConcurso()
    {
        return $this->valorAcumuladoConcurso;
    }
}
