<?php
namespace App\Classes\Cache;
/**
* Abstract Method da classe de Memcache
* @email msfidelis01@gmail.com
* @author Matheus Fidelis
*/
abstract class AbstractMemCache {
  /**
  * HOST do servidor de Memcache
  * @var [type]
  */
  public static $host;
  /**
  * Porta do servidor de Memcache
  * @var [type]
  */
  public static $port;
  /**
  * Instance do Memcache
  * @var [type]
  */
  protected $server;
  public function __construct() {
    $this->server = new \Memcache();
    $this->server->addServer(self::$host, self::$port);
  }
}
