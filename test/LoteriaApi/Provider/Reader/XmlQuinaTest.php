<?php

namespace LoteriaApi\Provider\Reader;

use Loteria\Config;

class XmlQuinaTest extends \PHPUnit_Framework_TestCase {
    private $xmlQuina;
    
    public function testXmlQuinaClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Provider\Reader\XmlQuina'),
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
         	   'quina' => [
                	'xml'     => "test_quina.xml",
            	]
        	]));

        $this->xmlQuina = new XmlQuina($mockConfigPath, $mockConfigDatasource);
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
    	$concurso = $this->xmlQuina->findByConcurso($concurso);
	}

    public function testFindByConcursoShouldReturnAValidConcurso() {
    	$concurso = $this->xmlQuina->findByConcurso(1);
    	$concursoExpected = [
            0 => [
                'concurso' => '1',
                'data' => '13/03/1994',
                'dezenas' => [
                    0 => '25',
                    1 => '45',
                    2 => '60',
                    3 => '76',
                    4 => '79',
                ],
                'arrecadacao' => '0,00',
                'total_ganhadores' => '3',
                'acumulado' => 'NÃO',
                'valor_acumulado' => '0,00'
            ]
        ];
	    $this->assertEquals($concursoExpected, $concurso);
    }

    public function testFindLastConcursoShouldReturnAValidConcurso() {
        $concurso = $this->xmlQuina->findLastConcurso();
        $concursoExpected = [
            0 => [
                'concurso' => '3399',
                'data' => '24/01/2014',
                'dezenas' => [
                    0 => '55',
                    1 => '75',
                    2 => '42',
                    3 => '23',
                    4 => '64',
                ],
                'arrecadacao' => '5.909.673,75',
                'total_ganhadores' => '0',
                'acumulado' => 'SIM',
                'valor_acumulado' => '1.170.673,89'
            ]
        ];
        $this->assertEquals($concursoExpected, $concurso);
    }

}
