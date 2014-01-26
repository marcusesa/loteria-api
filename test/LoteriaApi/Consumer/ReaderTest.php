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

    public function testGetDataShouldReturnArrayExpectOfQuina(){
        $dataExpect = [
            'quina' => [
                // primeiro concurso
                1 => [
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
                ],
                // ultimo concurso
                3399 => [
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
                ],
            ]
        ];
        
        $datasources = [
            'quina' => [
                'html'    => "test_D_QUINA.HTM",
                'reader'  => "LoteriaApi\Consumer\Reader\Quina",
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
        
        $this->assertArrayHasKey('quina', $dataExpect);
        $this->assertEquals($dataExpect['quina'][1],     $data['quina'][1]);
        $this->assertEquals($dataExpect['quina'][3399],  $data['quina'][3399]);
    }

    public function testGetDataShouldReturnArrayExpectOfLotomania(){
        $dataExpect = [
            'lotomania' => [
                // primeiro concurso
                1 => [
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
                ],
                // ultimo concurso
                1420 => [
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
                ],
            ]
        ];
        
        $datasources = [
            'lotomania' => [
                'html' => 'test_D_LOTMAN.HTM',
                'reader' => 'LoteriaApi\Consumer\Reader\Lotomania',
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
        
        $this->assertArrayHasKey('lotomania', $dataExpect);
        $this->assertEquals($dataExpect['lotomania'][1],     $data['lotomania'][1]);
        $this->assertEquals($dataExpect['lotomania'][1420],  $data['lotomania'][1420]);
    }
}