<?php

namespace LoteriaApi\Provider\Reader;

use Loteria\Config;

class XmlLotofacilTest extends \PHPUnit_Framework_TestCase {
    private $xmlLotofacil;
    
    public function testXmlLotofacilClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Provider\Reader\XmlLotofacil'),
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
         	   'lotofacil' => [
                	'xml'     => "test_lotofacil.xml",
            	]
        	]));

        $this->xmlLotofacil = new XmlLotofacil($mockConfigPath, $mockConfigDatasource);
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
    	$concurso = $this->xmlLotofacil->findByConcurso($concurso);
	}

    public function testFindByConcursoShouldReturnAValidConcurso() {
    	$concurso = $this->xmlLotofacil->findByConcurso(1);
    	$concursoExpected = [
            0 => [
                'concurso' => '1',
                'data' => '29/09/2003',
                'dezenas' => [
                    0 => '18',
                    1 => '20',
                    2 => '25',
                    3 => '23',
                    4 => '10',
                    5 => '11',
                    6 => '24',
                    7 => '14',
                    8 => '06',
                    9 => '02',
                    10 => '13',
                    11 => '09',
                    12 => '05',
                    13 => '16',
                    14 => '03',
                ],
                'arrecadacao' => '0,00',
                'total_ganhadores' => '5',
                'acumulado' => 'NÃO',
                'valor_acumulado' => '0,00'
            ]
        ];
	    $this->assertEquals($concursoExpected, $concurso);
    }

    public function testFindLastConcursoShouldReturnAValidConcurso() {
        $concurso = $this->xmlLotofacil->findLastConcurso();
        $concursoExpected = [
            0 => [
                'concurso' => '992',
                'data' => '09/12/2013',
                'dezenas' => [
                    0 => '05',
                    1 => '17',
                    2 => '08',
                    3 => '24',
                    4 => '20',
                    5 => '15',
                    6 => '11',
                    7 => '13',
                    8 => '09',
                    9 => '03',
                    10 => '19',
                    11 => '01',
                    12 => '07',
                    13 => '04',
                    14 => '10',
                ],
                'arrecadacao' => '19.036.316,25',
                'total_ganhadores' => '3',
                'acumulado' => 'NÃO',
                'valor_acumulado' => '0,00'
            ]
        ];
        $this->assertEquals($concursoExpected, $concurso);
    }

}
