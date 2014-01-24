<?php

namespace LoteriaApi\Consumer;

class WriterTest extends \PHPUnit_Framework_TestCase {
    private $writer;
    
    public function testWriterClassExist() {
        $this->assertTrue(
                class_exists($class = 'LoteriaApi\Consumer\Writer'),
                'Class not found: '.$class
        );
    }
    
    public function setUp() {
        $this->writer = new Writer();
    }
    
    public function testSetDataSourceShouldReturnInstanceOfWriter() {
        $instance = $this->writer->setDataSource([]);
        $this->assertInstanceOf('LoteriaApi\Consumer\Writer', $instance);
    }
    
    public function testSetLocalStorageShouldReturnInstanceOfWriter() {
        $instance = $this->writer->setLocalStorage('test');
        $this->assertInstanceOf('LoteriaApi\Consumer\Writer', $instance);
    }
    
    public function testSetDataShouldReturnInstanceOfWriter() {
        $instance = $this->writer->setData([]);
        $this->assertInstanceOf('LoteriaApi\Consumer\Writer', $instance);
    }
    
    public function testRunShouldCreateXmlOfMegasena() {
        $datasources = [
            'megasena' => [
                'xml' => 'megasena.xml'
            ]
        ];

        $paths = [
            'path' => [
                'xml' => API_PATH . 'var' . DS . '_test' . DS . 'xml' . DS
            ]
        ];
        
        $data = [
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
        
        $this->writer
            ->setDataSource($datasources)
            ->setLocalStorage($paths['path']['xml'])    
            ->setData($data)
            ->run();
        
        $file = $paths['path']['xml'].$datasources['megasena']['xml'];
        $this->assertFileExists($file);
        $fileTest = $paths['path']['xml'].'test_megasena.xml';
        $this->assertFileEquals($fileTest, $file);
        unlink($file);
    }

    
    public function testRunShouldCreateXmlOfLotofacil() {
        $datasources = [
            'lotofacil' => [
                'xml' => 'lotofacil.xml'
            ]
        ];

        $paths = [
            'path' => [
                'xml' => API_PATH . 'var' . DS . '_test' . DS . 'xml' . DS
            ]
        ];

        $data = [
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
        
        $this->writer
            ->setDataSource($datasources)
            ->setLocalStorage($paths['path']['xml'])    
            ->setData($data)
            ->run();
        
        $file = $paths['path']['xml'].$datasources['lotofacil']['xml'];
        $this->assertFileExists($file);
        $fileTest = $paths['path']['xml'].'test_lotofacil.xml';
        $this->assertFileEquals($fileTest, $file);
        unlink($file);
    }    

}
