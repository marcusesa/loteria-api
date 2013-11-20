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
    
    public function testRunShouldCreateXmlForMegasena() {
        $config = $this->getMock('\LoteriaApi\Config', ['getData']);
        $config->expects($this->any())
            ->method('getData')
           ->will($this->returnValue([
            'megasena' => [
                'xml' => 'megasena.xml'
            ]
        ]));

        $datasources = $config->getData();

        $config = $this->getMock('\LoteriaApi\Config', ['getData']);
        $config->expects($this->any())
            ->method('getData')
           ->will($this->returnValue([
            'path' => [
                'xml' => API_PATH . 'var' . DS . '_test' . DS . 'xml' . DS
            ]
        ]));

        $paths = $config->getData();
        
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

}
