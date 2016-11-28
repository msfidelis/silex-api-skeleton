<?php
namespace App\Providers\Cache;

use Silex\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use App\Providers\Cache\Memcache\MemCacheClient;

/**
* Provider de Cache - Inialmente irá trabalhar com o Memcache
* @email msfidelis01@gmail.com
* @author Matheus Fidelis
*/
class CacheProvider implements ServiceProviderInterface, BootableProviderInterface {
  public function register (Container $app) {
    $app['cache.host'] = 'localhost';
    $app['cache.port'] = '11211';
    $app['cache.type'] = 'memcache';
    $app['cache.client'] = (

    function() use ($app) {

      switch ($app['cache.type']) {
        case 'memcache':
          $cacheServer = new \Memcache();
          $cacheServer->addServer($app['cache.host'], $app['cache.port']);
          $client = new MemCacheClient($cacheServer);
        break;

        default:
        # code...
        break;
      }

      return $client;
    }

  );
}

public function boot(Application $app) {

}
}
