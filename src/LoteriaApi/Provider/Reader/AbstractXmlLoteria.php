<?php

namespace LoteriaApi\Provider\Reader;

use LoteriaApi\Config;

abstract class AbstractXmlLoteria implements IFinder
{
    protected $configPath;
    protected $configDatasource;
    protected $filename;

    public function __construct(Config $configPath, Config $configDatasource)
    {
        $this->configPath = $configPath;
        $this->configDatasource = $configDatasource;
        $this->putFileName();
    }

    abstract protected function putFileName();

    private function formatResultXpathToConcursoArray($resultXpath)
    {
        $arrayConcursos = [];

        foreach ($resultXpath as $key => $concurso) {
            $arrayConcursos[$key]['concurso'] = (string) $concurso->attributes()->numero;

            $children = $concurso[0]->children();

            $arrayConcursos[$key]['data'] = (string) $children->data;
            $arrayConcursos[$key]['dezenas'] = (array) $children->dezenas->children()->dezena;
            $arrayConcursos[$key]['arrecadacao'] = (string) $children->arrecadacao;
            $arrayConcursos[$key]['total_ganhadores'] = (string) $children->total_ganhadores;
            $arrayConcursos[$key]['acumulado'] = (string) $children->acumulado;
            $arrayConcursos[$key]['valor_acumulado'] = (string) $children->valor_acumulado;
        }

        return $arrayConcursos;
    }

    private function getSimpleXml()
    {
        return simplexml_load_file($this->filename);
    }

    public function findByConcurso($nrconcurso)
    {
        $concurso = $this->getSimpleXml()
            ->xpath("/concursos/concurso[@numero='{$nrconcurso}']");

        if (!isset($concurso[0])) {
             throw new \InvalidArgumentException("Concurso does not exist");
        }
        
        $concurso = $this->formatResultXpathToConcursoArray($concurso);

        return $concurso;
    }

    public function findLastConcurso()
    {
        $concurso = $this->getSimpleXml()
            ->xpath("(/concursos/concurso)[last()]");
        
        $concurso = $this->formatResultXpathToConcursoArray($concurso);

        return $concurso;
    }
}
