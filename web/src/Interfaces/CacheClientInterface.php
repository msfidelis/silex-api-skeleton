<?php
namespace App\Interfaces;

/**
* Interface de Cache
* @email msfidelis01@gmail.com
* @author Matheus Fidelis
*/
interface CacheClientInterface {
  /**
  *Construct Method
  * @param [type] $server [description]
  */
  public function __construct($server);

  /**
  * Seta o Cache no servidor
  * @param [type]  $key     [chave]
  * @param [type]  $value   [valor]
  * @param [type]  $timeout [timeout do cache]
  * @param boolean $zlib    [compressão]
  */
  public function setCache($key, $value, $timeout, $zlib = false);

  /**
  * Pega os valores no servidor de cache
  * @param  [type] $key [chave]
  * @return [type]      [valor]
  */
  public function getCache($key);
}
