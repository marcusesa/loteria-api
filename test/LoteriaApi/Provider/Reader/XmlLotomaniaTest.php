<?php

namespace LoteriaApi\Provider\Reader;

use Loteria\Config;

class XmlLotomaniaTest extends \PHPUnit_Framework_TestCase {
    private $xmlLotomania;
    
    public function testXmlLotomaniaClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Provider\Reader\XmlLotomania'),
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
         	   'lotomania' => [
                	'xml'     => "test_lotomania.xml",
            	]
        	]));

        $this->xmlLotomania = new XmlLotomania($mockConfigPath, $mockConfigDatasource);
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
    	$concurso = $this->xmlLotomania->findByConcurso($concurso);
	}

    public function testFindByConcursoShouldReturnAValidConcurso() {
    	$concurso = $this->xmlLotomania->findByConcurso(1);
    	$concursoExpected = [
            0 => [
                'concurso' => '1',
                'data' => '02/10/1999',
                'dezenas' => [
                    0 => '16',
                    1 => '11',
                    2 => '88',
                    3 => '32',
                    4 => '25',
                    5 => '00',
                    6 => '70',
                    7 => '78',
                    8 => '73',
                    9 => '61',
                    10 => '90',
                    11 => '89',
                    12 => '46',
                    13 => '95',
                    14 => '06',
                    15 => '33',
                    16 => '34',
                    17 => '21',
                    18 => '14',
                    19 => '22',
                ],
                'arrecadacao' => '0,00',
                'total_ganhadores' => '0',
                'acumulado' => 'SIM',
                'valor_acumulado' => '178.120,31'
            ]
        ];
	    $this->assertEquals($concursoExpected, $concurso);
    }

    public function testFindLastConcursoShouldReturnAValidConcurso() {
        $concurso = $this->xmlLotomania->findLastConcurso();
        $concursoExpected = [
            0 => [
                'concurso' => '1420',
                'data' => '22/01/2014',
                'dezenas' => [
                    0 => '26',
                    1 => '67',
                    2 => '12',
                    3 => '60',
                    4 => '77',
                    5 => '68',
                    6 => '39',
                    7 => '34',
                    8 => '79',
                    9 => '59',
                    10 => '35',
                    11 => '93',
                    12 => '92',
                    13 => '73',
                    14 => '23',
                    15 => '70',
                    16 => '27',
                    17 => '96',
                    18 => '17',
                    19 => '36',
                ],
                'arrecadacao' => '5.231.545,50',
                'total_ganhadores' => '0',
                'acumulado' => 'SIM',
                'valor_acumulado' => '2.397.228,70'
            ]
        ];
        $this->assertEquals($concursoExpected, $concurso);
    }

}
