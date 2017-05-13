<?php

namespace App\Tests;
use Silex\WebTestCase;

/**
* Um simples esquema de como rodar testes no Silex PHP
* Mais precisamente esse mini framework :)
*/
class exampleTest extends WebTestCase {
    
    /**
    * SetUp Method
    */
    public function setUp() {
        parent::setUp();
    }
    
    /**
    * Garante nossa instância de do Application
    * @return [type] [description]
    */
    public function createApplication() {
        $app = require __DIR__ . '/../Configs/Bootstrap.php';
        return $app;
    }
    
    /**
    * Verifica se retorna um Json legalzão
    * @return [type] [description]
    */
    public function testHostname() {
        $client = $this->createClient();
        $client->request('GET', '/api/hostname');
        
        $response = json_decode($client->getResponse()->getContent());
        
        $this->assertTrue(isset($response->hostname));
        
        $this->assertEquals(200, $client->getInternalResponse()->getStatus());
        $this->assertEquals('application/json', $client->getInternalResponse()->getHeaders()['content-type'][0]);
    }
}