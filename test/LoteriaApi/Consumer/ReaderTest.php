<?php

namespace LoteriaApi\Consumer;

class ReaderTest extends \PHPUnit_Framework_TestCase {
    private $reader;
    
    public function testReaderClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Consumer\Reader'),
                'Class not found: '.$class
        );
    }
    
    public function setUp() {
        $this->reader = new Reader();
    }
    
    public function testSetDatasourceShouldReturnInstanceOfReader(){
        $instance = $this->reader->setDataSource([]);
        $this->assertInstanceOf('LoteriaApi\Consumer\Reader', $instance);
    }
    
    public function testSetPathsStorageShouldReturnInstanceOfReader() {
        $instance = $this->reader->setPathsStorage('test');
        $this->assertInstanceOf('LoteriaApi\Consumer\Reader', $instance);
    }
    
    public function testGetDataShouldReturnArrayExpectOfMegasena(){
        $dataExpect = [
            'megasena' => [
                // primeiro concurso
                1 => [
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
                ],
                // ultimo concurso
                1547 => [
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
                ]
            ]
        ];
        
        $datasources = [
            'megasena' => [
                'html' => 'test_D_MEGA.HTM',
                'reader' => 'LoteriaApi\Consumer\Reader\Megasena',
            ]
        ];
        
        $paths = [
            'path' => [
                'ext' => API_PATH . 'var' . DS . '_test' . DS . 'ext' . DS,
            ]
        ];
        
        $data = $this->reader
            ->setDataSource($datasources)
            ->setPathsStorage($paths)
            ->getData();
        
        $this->assertArrayHasKey('megasena', $dataExpect);
        $this->assertEquals($dataExpect['megasena'][1],     $data['megasena'][1]);
        $this->assertEquals($dataExpect['megasena'][1547],  $data['megasena'][1547]);
    }

    public function testGetDataShouldReturnArrayExpectOfLotofacil(){
        $dataExpect = [
            'lotofacil' => [
                // primeiro concurso
                1 => [
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
                ],
                // ultimo concurso
                992 => [
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
                ],
            ]
        ];
        
        $datasources = [
            'lotofacil' => [
                'html' => 'test_D_LOTFAC.HTM',
                'reader' => 'LoteriaApi\Consumer\Reader\Lotofacil',
            ]
        ];
        
        $paths = [
            'path' => [
                'ext' => API_PATH . 'var' . DS . '_test' . DS . 'ext' . DS,
            ]
        ];
        
        $data = $this->reader
            ->setDataSource($datasources)
            ->setPathsStorage($paths)
            ->getData();
        
        $this->assertArrayHasKey('lotofacil', $dataExpect);
        $this->assertEquals($dataExpect['lotofacil'][1],     $data['lotofacil'][1]);
        $this->assertEquals($dataExpect['lotofacil'][992],  $data['lotofacil'][992]);
    }
}