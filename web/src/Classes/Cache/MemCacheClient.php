<?php
namespace App\Classes\Cache;
use App\Interfaces\CacheClient;
use App\Classes\Cache\AbstractMemCache;

class MemCacheClient extends AbstractMemCache implements CacheClient {

  /**
  * Memcache Instance
  * @var object
  */
  /**
  * Class Constructor
  * @param Memcache $server [description]
  */
  public function __construct() {
    parent::__construct();
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
