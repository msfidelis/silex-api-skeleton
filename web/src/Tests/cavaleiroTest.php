<?php

namespace App\Tests;
use Silex\WebTestCase;

use App\Models\Entity\Cavaleiro;
use App\Classes\CavaleirosDoZodiaco\Combate;


/**
* Um simples esquema de como rodar testes no Silex PHP
* Mais precisamente esse mini framework :)
*/
class cavaleiroTest extends WebTestCase {

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
  * [testNaoDeveDeixarColocarQualquerValorNaForca description]
  *  @expectedException InvalidArgumentException
  */
  public function testNaoDeveDeixarColocarQualquerValorNaForca() {
    $seyaDePegasu = new Cavaleiro();
    $seyaDePegasu->setForca('batatinah');
  }

  /**
  * [testNaoDeveDeixarUmCavaleiroDeAcoEntrarNaBatalha description]
  * @expectedException InvalidArgumentException
  */
  public function testNaoDeveDeixarUmCavaleiroDeAcoEntrarNaBatalha() {
    $cavaleiroPenetra = new Cavaleiro();
    $cavaleiroPenetra->setOrdem('aço');
  }

  /**
  * [testDeveValidarONomeDoCavaleiro description]
  * @return [type] [description]
  */
  public function testDeveValidarOsAtributosDoCavaleiro() {
    $cavaleiroFoda = new Cavaleiro();
    $cavaleiroFoda->setNome('Shiryu')
    ->setOrdem('bronze')
    ->setForca(123);

    $this->assertEquals('Shiryu', $cavaleiroFoda->getNome());
    $this->assertEquals('bronze', $cavaleiroFoda->getOrdem());
    $this->assertEquals(123, $cavaleiroFoda->getForca());
  }
}
