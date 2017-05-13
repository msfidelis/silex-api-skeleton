<?php
namespace App\Interfaces;

/**
* Interface para comunicação entre os cavaleiros de Athena
*/
interface CavaleiroDeAtena {


  /**
   * [setOrdem description]
   */
  public function setOrdem($ordem);

  /**
   * [getOrdem description]
   * @return [type] [description]
   */
  public function getOrdem();

  /**
   * [setNome description]
   */
  public function setNome($nome);

  /**
   * [getNome description]
   * @return [type] [description]
   */
  public function getNome();

  /**
   * [setForca description]
   */
  public function setForca($forca);

  /**
   * [getForca description]
   * @return [type] [description]
   */
  public function getForca();



}
