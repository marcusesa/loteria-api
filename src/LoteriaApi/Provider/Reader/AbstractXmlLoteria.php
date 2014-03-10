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

    private function convertObjectToArrayRecursive($object)
    {
        $array = (array) $object;
        array_walk_recursive($array, function (&$value) {
            if (is_object($value)) {
                $value = (array) $value->dezena;
            }
        });
        return $array;
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
        
        $concurso = $concurso[0]->children();
        $concurso = $this->convertObjectToArrayRecursive($concurso);

        return $concurso;
    }

    public function findLastConcurso()
    {
        $concurso = $this->getSimpleXml()
            ->xpath("(/concursos/concurso)[last()]");

        $concurso = $concurso[0]->children();
        $concurso = $this->convertObjectToArrayRecursive($concurso);

        return $concurso;
    }
}
