<?php

namespace LoteriaApi\Provider\Routes;

use Silex\WebTestCase;
use LoteriaApi\Provider\Factory;

class IndexTest extends WebTestCase {
    
    public function createApplication() {
        $app = require __DIR__.'/../../../../web/app.php';

        $mockConfigPath = $this->getMock('\LoteriaApi\Config');
        $mockConfigPath->expects($this->any())
            ->method('getData')
            ->will($this->returnValue([
               'path' => [
                    'xml' => API_PATH . 'var' . DS . '_test' . DS . 'xml' . DS,
                ]
            ]));

        $mockConfigDatasource = $this->getMock('\LoteriaApi\Config');
        $mockConfigDatasource->expects($this->any())
            ->method('getData')
            ->will($this->returnValue([
               'lotomania' => [
                    'xml'     => "test_lotomania.xml",
                ],
                'lotofacil' => [
                    'xml'     => "test_lotofacil.xml",
                ],
                'quina' => [
                    'xml'     => "test_quina.xml",
                ],
                'megasena' => [
                    'xml'     => "test_megasena.xml",
                ]
            ]));

        // Overwrite Factory with Config mock 
        $app['factory'] = $app->share(function ($app) use($mockConfigPath, $mockConfigDatasource) {
            return new Factory($mockConfigPath, $mockConfigDatasource);
        });

        return $app;
    }

    public function testIndexShouldReturnOk200() {
        $client = $this->createClient();
        
        $client->request('GET', '/?loteria=megasena&concurso=1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request('GET', '/?loteria=quina&concurso=1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request('GET', '/?loteria=lotomania&concurso=1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request('GET', '/?loteria=lotofacil&concurso=1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testIndexShouldReturnAContentValid() {
        $client = $this->createClient();

        $pathJsonTest = API_PATH . 'var' . DS . '_test' . DS . 'json' . DS;

        $client->request('GET', '/?loteria=megasena&concurso=1');
        $this->assertJsonStringEqualsJsonFile(
            $pathJsonTest.'test_megasena.json' , $client->getResponse()->getContent()
        );

        $client->request('GET', '/?loteria=quina&concurso=1');
        $this->assertJsonStringEqualsJsonFile(
            $pathJsonTest.'test_quina.json' , $client->getResponse()->getContent()
        );

        $client->request('GET', '/?loteria=lotofacil&concurso=1');
        $this->assertJsonStringEqualsJsonFile(
            $pathJsonTest.'test_lotofacil.json' , $client->getResponse()->getContent()
        );

        $client->request('GET', '/?loteria=lotomania&concurso=1');
        $this->assertJsonStringEqualsJsonFile(
            $pathJsonTest.'test_lotomania.json' , $client->getResponse()->getContent()
        );
    }

    public function testIndexShouldReturnBadRequest400() {
        $client = $this->createClient();

        $client->request('GET', '/?loteria=dontexist&concurso=1');
        $this->assertEquals(400, $client->getResponse()->getStatusCode());

        $client->request('GET', '/?loteria=lotofacil&concurso=dontexist');
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    /**

    --Falta
    Ok -> Testar o erro da requisição.
    Testar o sucesso e erro da resposta da requisição (usar arquivos json em var/_test/json para a comparação).

    http://symfony.com/doc/current/book/testing.html#the-test-client

    */

}
