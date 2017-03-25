<?php
namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;

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
		
		return $index;
	}


}
