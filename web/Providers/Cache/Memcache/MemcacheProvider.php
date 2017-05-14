<?php
namespace App\Providers\Cache\Memcache;

use App\Interfaces\CacheClientInterface;

/**
* Client do Memcache
* @email msfidelis01@gmail.com
* @author Matheus Fidelis
*/
class MemcacheClient  {
  /**
  * Memcache Instance
  * @var object
  */
  private $server;

  /**
  * Class Constructor
  * @param Memcache $server [description]
  */
  public function __construct($server) {
    $this->server = $server;
  }

  /**
  * Retorna um item do Cache
  * @param  [type] $key [description]
  * @return [type]      [description]
  */
  public function getCache($key) {
    return $this->server->get($key);
  }

  /**
  * Seta um novo cache no sistema
  * @param [type]  $key     [description]
  * @param [type]  $value   [description]
  * @param integer $timeout [description]
  * @param boolean $zlib    [description]
  */
  public function setCache($key, $value, $timeout = 600, $zlib = false) {
    if ($zlib) {
      $zlib = MEMCACHE_COMPRESSED;
    }
    if (!$key) {
      throw new \Exception("Chave não informada", 1);
    }
    if (!$value) {
      throw new \Exception("Valor não informado", 1);
    }
    return $this->server->set($key, $value, $zlib, $timeout);
  }
}
