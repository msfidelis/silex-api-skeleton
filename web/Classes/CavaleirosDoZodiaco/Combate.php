<?php

namespace App\Classes\CavaleirosDoZodiaco;

use App\Interfaces\CavaleiroDeAtena;

/**
 * Classe de combate - Aqui vemos qual dos dois se sai melhor
 */
class Combate {

  /**
   * [$cavaleiroDesafiante description]
   * @var [type]
   */
  private $cavaleiroDesafiante;

  /**
   * [$cavaleiroDesafiado description]
   * @var [type]
   */
  private $cavaleiroDesafiado;

  /**
   * [$cavaleiroVencedor description]
   * @var [type]
   */
  private $cavaleiroVencedor;

  /**
   * [$melhorDesempenho description]
   * @var [type]
   */
  private $melhorDesempenho;

  /**
   * Verifica qual dos dois cavaleiros é o mais poderoso
   * @return [type] [description]
   */
  public function iniciarCombate() {
    if ($this->cavaleiroDesafiante->getForca() > $this->cavaleiroDesafiado->getForca()) {
      $this->cavaleiroVencedor = $this->cavaleiroDesafiante;
    } else {
      $this->cavaleiroVencedor = $this->cavaleiroDesafiado;
    }
  }

  /**
   * [setDesafiante description]
   * @param CavaleiroDeAtena $cavaleiroDesafiante [description]
   */
  public function setDesafiante(CavaleiroDeAtena $cavaleiroDesafiante) {
    $this->cavaleiroDesafiante = $cavaleiroDesafiante;
  }

  /**
   * [setDesafiado description]
   * @param CavaleiroDeAtena $cavaleiroDesafiado [description]
   */
  public function setDesafiado(CavaleiroDeAtena $cavaleiroDesafiado) {
    $this->cavaleiroDesafiado = $cavaleiroDesafiado;
  }

  /**
  * [getVencedor description]
   * @return [type] [description]
   */
  public function getVencedor() {
    return $this->cavaleiroVencedor;
  }



}
