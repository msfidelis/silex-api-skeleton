<?php
namespace App\Controllers;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\CompanyModel as Company;

/**
 * Exemplo de Controller da API
 * @email msfidelis01@gmail.com
 * @author Matheus Fidelis
 */
class ApiController implements ControllerProviderInterface {

  /**
   * Connect Method - Guarda todas as rotas direcionadas para este
   * controller
   * @param Application $app
   * @return Application
   */
  public function connect(Application $app) {
    $api = $app['controllers_factory'];

    /**
     * Exemplo de rota que retorna uma View do Twig
     */
    $api->get('/', function(Application $app) {
      return $app->json(['oi' => 'fodase']);
    });

    
    /**
     * Exemplo de rota via GET
     */
    $api->get('/all', function (Application $app) {
 		$content = (new Company())->findAll();
  		return $app->json($content);
    });

    /**
     * Exemplo de rota via GET
     */
    $api->get('/get/{id}', function ($id) use ($app) {
    	$content = (new Company())->findEmployeeByID((int) $id);
    	return $app->json($content);
    });
    
    /**
     * Exemplo de rota via POST que adiciona um item
     */
    $api->post('/add', function (Request $request) use ($app) {
    	$data = (object) $request->request->all();
    	$post = array(
	        "name" => "'$data->name'",
	        "age" => $data->age ? (int) $data->age : null,
	        "address" => $data->address ? "'{$data->address}'" : null,
	        "salary" => $data->salary ? (float) $data->salary : null
      ); 

    	if ((new Company())->insert($post)) {
    		$return = array('status' => 200);
    	} else {
    		$return = array('status' => 400);
    	}

    	return $app->json($return);
    });
    
    /**
     * Exemplo de rota via PUT que atualiza um item
     */
    $api->put('/add/{id}', function(Request $request, $id) use ($app) {

    	if ((new Company())->update((int) $id, $request->request->all())) {
    		$return = array('status' => 200);
    	} else {
    		$return = array('status' => 400);
    	}

    	return $app->json($return);
    });
    
    /**
     * Exemplo de rota via DELETE que exclui um item
     */
    $api->delete('/delete/{id}', function($id) use ($app) {
   		if ((new Company())->delete((int) $id)) {
   			$return = array('status' => 200);
   		} else {
   			$return = array('status' => 400);
    	}
    	return $app->json($return);
    });

    return $api;
  }
}
