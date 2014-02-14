<?php

namespace LoteriaApi\Provider;

use LoteriaApi\Config;
use LoteriaApi\Provider\Reader\XmlMegasena;
use LoteriaApi\Provider\Reader\XmlQuina;
use LoteriaApi\Provider\Reader\XmlLotofacil;
use LoteriaApi\Provider\Reader\XmlLotomania;

use InvalidArgumentException;

class Factory
{
    private $config;

    public function __construct(Config $configPath, Config $configDatasource)
    {
        $this->config['path'] = $configPath;
        $this->config['datasource'] = $configDatasource;
    }

    public function getLoteria($loteria)
    {
        switch ($loteria) {
            case 'megasena':
                return new XmlMegasena($this->config['path'], $this->config['datasource']);
                break;
            case 'quina':
                return new XmlQuina($this->config['path'], $this->config['datasource']);
                break;
            case 'lotofacil':
                return new XmlLotofacil($this->config['path'], $this->config['datasource']);
                break;
            case 'lotomania':
                return new XmlLotomania($this->config['path'], $this->config['datasource']);
                break;
            
            default:
                throw new InvalidArgumentException();
                break;
        }
    }
}
