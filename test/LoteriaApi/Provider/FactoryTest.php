<?php

namespace LoteriaApi\Provider;

use Loteria\Config;

class FactoryTest extends \PHPUnit_Framework_TestCase {
    private $factory;
    
    public function testFactoryClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Provider\Factory'),
                'Class not found: '.$class
        );
    }

    public function setUp() {
    	$mockConfig = $this->getMock('\LoteriaApi\Config');
        $this->factory = new Factory($mockConfig, $mockConfig);
    }

    public function providerGetLoteriaShouldThrownAnException()
    {
        return [
            [1],
            ['invalid_loteria'],
            [-1],
        ];
    }

	/**
     * @dataProvider providerGetLoteriaShouldThrownAnException
     * @expectedException InvalidArgumentException
     */
    public function testGetLoteriaShouldThrownAnException($loteria) {
    	$loteria = $this->factory->getLoteria($loteria);
	}

    public function providerGetLoteriaShouldReturnAValidObject()
    {
        return [
            ['LoteriaApi\Provider\Reader\XmlQuina' ,'quina'],
            ['LoteriaApi\Provider\Reader\XmlMegasena' ,'megasena'],
            ['LoteriaApi\Provider\Reader\XmlLotomania' ,'lotomania'],
            ['LoteriaApi\Provider\Reader\XmlLotofacil' ,'lotofacil'],
        ];
    }

    /**
     * @dataProvider providerGetLoteriaShouldReturnAValidObject
     */
    public function testGetLoteriaShouldReturnAValidObject($objectLoteria, $stringLoteria) {
        $instanceLoteria = $this->factory->getLoteria($stringLoteria);
        $this->assertInstanceOf($objectLoteria, $instanceLoteria);
    }

}
