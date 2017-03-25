<?php
namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
* Exemplo de Controller
*/
class IndexController implements ControllerProviderInterface {
    
    /**
    * Connect Method
    * @param Application $app
    * @return Application
    */
    public function connect(Application $app) {
        
        /**
        * Middlewares do controller
        */
        $app->before(function (Request $request, Application $app) {
            
        });
        
        $index = $app['controllers_factory'];
        
        /**
        * Index Route
        */
        $index->get('/', function() use ($app) {
            return $app->json('hello');
        });
        
        $index->get('/server', function() use ($app) {
            return $app->json(['php-version' => phpversion()]);
        });
        
        $index->get('/hostname', function() use ($app) {
            return new Response();
        });
        
        $index->get('/phpinfo', function() use ($app) {
            return new Response(phpinfo(), 200, array(
            'Cache-Control' => 's-maxage=510',
            ));
        });
        
        return $index;
    }
    
    
}