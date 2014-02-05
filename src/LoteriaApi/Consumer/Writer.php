<?php

namespace LoteriaApi\Consumer;

class Writer
{
    private $datasource;
    private $localstorage;
    private $data;
    
    public function setDataSource(array $datasource)
    {
        $this->datasource = $datasource;
        return $this;
    }
    
    public function setLocalStorage($localstorage)
    {
        $this->localstorage = $localstorage;
        return $this;
    }
    
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }
    
    public function run()
    {
        foreach ($this->datasource as $concursoName => $concurso) {
            
            $xml = new \SimpleXMLElement('<concursos/>');
            
            foreach ($this->data[$concursoName] as $nrconcurso => $concursoData) {
                $concursoXml = $xml->addChild('concurso');
                $concursoXml->addAttribute('numero', $nrconcurso);
                $concursoXml->addChild('data', $concursoData['data']);
                $dezenas = $concursoXml->addChild('dezenas');
                foreach ($concursoData['dezenas'] as $dezena) {
                    $dezenas->addChild('dezena', $dezena);
                }
                $concursoXml->addChild('arrecadacao', $concursoData['arrecadacao']);
                $concursoXml->addChild('total_ganhadores', $concursoData['total_ganhadores']);
                $concursoXml->addChild('acumulado', $concursoData['acumulado']);
                $concursoXml->addChild('valor_acumulado', $concursoData['valor_acumulado']);
            }
            
            $filename = $this->localstorage . $concurso['xml'];
            
            $dom = new \DOMDocument('1.0');
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xml->asXML());
            $dom->save($filename);
        }
    }
}
