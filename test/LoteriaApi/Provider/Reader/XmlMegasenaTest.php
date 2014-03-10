<?php

namespace LoteriaApi\Provider\Reader;

use Loteria\Config;

class XmlMegasenaTest extends \PHPUnit_Framework_TestCase {
    private $xmlMegasena;
    
    public function testXmlMegasenaClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Provider\Reader\XmlMegasena'),
                'Class not found: '.$class
        );
    }

    public function setUp() {
    	$mockConfigPath = $this->getMock('\LoteriaApi\Config');
		$mockConfigPath->expects($this->once())
            ->method('getData')
            ->will($this->returnValue([
         	   'path' => [
                	'xml' => API_PATH . 'var' . DS . '_test' . DS . 'xml' . DS,
            	]
        	]));

    	$mockConfigDatasource = $this->getMock('\LoteriaApi\Config');
		$mockConfigDatasource->expects($this->once())
            ->method('getData')
            ->will($this->returnValue([
         	   'megasena' => [
                	'xml'     => "test_megasena.xml",
            	]
        	]));

        $this->xmlMegasena = new XmlMegasena($mockConfigPath, $mockConfigDatasource);
    }

    public function providerFortestFindByConcursoShouldThrownAnException()
    {
        return [
            [99999],
            [-200],
            ['asd'],
            [2.6],
        ];
    }

	/**
     * @dataProvider providerFortestFindByConcursoShouldThrownAnException
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Concurso does not exist
     */
    public function testFindByConcursoShouldThrownAnException($concurso) {
    	$concurso = $this->xmlMegasena->findByConcurso($concurso);
	}

    public function testFindByConcursoShouldReturnAValidConcurso() {
    	$concurso = $this->xmlMegasena->findByConcurso(1);
    	$concursoExpected = [
            'data' => '11/03/1996',
            'dezenas' => [
                0 => '41',
                1 => '05',
                2 => '04',
                3 => '52',
                4 => '30',
                5 => '33',
            ],
            'arrecadacao' => '0,00',
            'total_ganhadores' => '0',
            'acumulado' => 'SIM',
            'valor_acumulado' => '1.714.650,23'
        ];
	    $this->assertEquals($concursoExpected, $concurso);
    }

    public function testFindLastConcursoShouldReturnAValidConcurso() {
        $concurso = $this->xmlMegasena->findLastConcurso();
        $concursoExpected =  [
            'data' => '13/11/2013',
            'dezenas' => [
                0 => '28',
                1 => '21',
                2 => '09',
                3 => '10',
                4 => '02',
                5 => '18',
            ],
            'arrecadacao' => '34.028.022,00',
            'total_ganhadores' => '1',
            'acumulado' => 'NÃO',
            'valor_acumulado' => '0,00'
        ];
        $this->assertEquals($concursoExpected, $concurso);
    }

}
