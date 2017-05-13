<?php

namespace App\Tests;
use App\Tests\TestCase;

/**
* Um simples esquema de como rodar testes no Silex PHP
* Mais precisamente esse mini framework :)
*/
class exampleTest extends TestCase 
{
    
    /**
     * Test Hostname
     * @return void
     */
    public function testHostname() 
    {
        $client = $this->createClient();
        $client->request('GET', '/v1/server/hostname');
        
        $response = json_decode($client->getResponse()->getContent());
        
        $this->assertTrue(isset($response->hostname));
        $this->assertEquals(200, $client->getInternalResponse()->getStatus());
        $this->assertEquals('application/json', $client->getInternalResponse()->getHeaders()['content-type'][0]);
    }

    /**
     * Test PHP Version
     * @return void
     */
    public function testPHPVersion() 
    {
        $client = $this->createClient();
        $client->request("GET", "/v1/server/phpversion");
        
        $response = json_decode($client->getResponse()->getContent());

        $this->assertTrue(isset($response->phpversion));
        $this->assertEquals(phpversion(), $response->phpversion);
        $this->assertEquals('application/json', $client->getInternalResponse()->getHeaders()['content-type'][0]);
    }
}