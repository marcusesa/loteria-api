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

    public function findByConcurso($nrconcurso)
    {
        $concurso = simplexml_load_file($this->filename)
            ->xpath("/concursos/concurso[@numero='{$nrconcurso}']");

        if (isset($concurso[0])) {
            $concurso = $concurso[0]->children();
            $concurso = $this->convertObjectToArrayRecursive($concurso);
        } else {
             throw new \InvalidArgumentException("Concurso does not exist");
        }
        return $concurso;
    }
}
