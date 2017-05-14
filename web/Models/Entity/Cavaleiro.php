<?php

namespace App\Models\Entity;

use App\Interfaces\CavaleiroDeAtena;

/**
* Entidade que representa um Cavaleiro do Zodíaco
*/
class Cavaleiro implements CavaleiroDeAtena {

  /**
  * [$ordem description]
  * @var [type]
  */
  private $ordem;

  /**
  * [$nome description]
  * @var [type]
  */
  private $nome;


  /**
  * [$forca description]
  * @var [type]
  */
  private $forca;


  /**
  * [getOrden description]
  * @return [type] [description]
  */
  public function getOrdem() {
    return $this->ordem;
  }

  /**
  * Setter da Ordem dos Cavaleiros de Athena
  * @param [type] $ordem [description]
  */
  public function setOrdem($ordem) {

    /**
    * [$ordens description]
    * @var array
    */
    $ordensPermitidas = array(
      'bronze', 'prata', 'ouro'
    );

    if (in_array($ordem, $ordensPermitidas)) {
      $this->ordem = $ordem;
    } else {
      throw new \InvalidArgumentException("Ordem não permitida", 1);
    }

    return $this;
  }

  /**
  * Setter do Nome
  * @param [type] $nome [description]
  */
  public function setNome($nome) {
    $this->nome = $nome;
    return $this;
  }

  /**
  * [getNome description]
  * @return [type] [description]
  */
  public function getNome() {
    return $this->nome;
  }

  /**
  * [setForca description]
  * @param [type] $forca [description]
  */
  public function setForca($forca) {
    if (is_int($forca)) {
      $this->forca = $forca;
      return $this;
    } else {
      throw new \InvalidArgumentException("Força inválida", 1);
    }
  }

  /**
  * [getForca description]
  * @return [type] [description]
  */
  public function getForca() {
    return $this->forca;
  }

}
