<?php

namespace App\Tests;
use Silex\WebTestCase;

/**
 * Silex API TestCase
 */
abstract class TestCase extends WebTestCase 
{
      
    /**
    * SetUp Method
    */
    public function setUp() 
    {
        parent::setUp();
    }
    
    /**
    * Garante nossa instância de do Application
    * @return [type] [description]
    */
    public function createApplication() 
    {
        $app = require __DIR__ . '/../Configs/Bootstrap.php';
        return $app;
    }
}