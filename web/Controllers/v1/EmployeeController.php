<?php
namespace App\Controllers\v1;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\EmployeeModel as Employee;

/**
 * Exemplo de Controller da API
 * @email msfidelis01@gmail.com
 * @author Matheus Fidelis
 */
class EmployeeController implements ControllerProviderInterface 
{

  /**
   * Connect Method - Guarda todas as rotas direcionadas para este
   * controller
   * @param Application $app
   * @return Application
   */
  public function connect(Application $app) 
  {
    $api = $app['controllers_factory'];

    /**
     * Exemplo de rota via GET
     */
    $api->get('/', function (Application $app) {
 		$content = (new Employee())->findAll();
  		return $app->json($content);
    });

    /**
     * Exemplo de rota via GET
     */
    $api->get('/{id}', function ($id) use ($app) {
    	$content = (new Employee())->findEmployeeByID((int) $id);
    	return $app->json($content);
    });

    /**
     * Exemplo de rota via POST que adiciona um item
     */
    $api->post('', function (Request $request) use ($app) {

    	$data = (object) $request->request->all();

    	$post = array(
	        "name" => "'$data->name'",
	        "age" => $data->age ? (int) $data->age : null,
	        "salary" => $data->salary ? (float) $data->salary : null
      );

      $newEmployee = (new Employee())->insert($post);
    	if ($newEmployee) {
    		$return = $newEmployee;
        $code = 201;
    	} else {
    		$return = array('status' => 'error');
        $code = 500;
    	}

    	return $app->json($return, $code);
    });

    /**
     * Exemplo de rota via PUT que atualiza um item
     */
    $api->put('/{id}', function(Request $request, $id) use ($app) {

      $update = (new Employee())->update((int) $id, $request->request->all());

    	if ($update) {
    		$return = $update;
        $code = 200;
    	} else {
    		$return = array('status' => 500);
        $code = 500;
    	}

    	return $app->json($return, $code);
    });

    /**
     * Exemplo de rota via DELETE que exclui um item
     */
    $api->delete('/{id}', function($id) use ($app) {
   		if ((new Employee())->delete((int) $id)) {
   			$return = array('status' => 204);
        $code = 204;
   		} else {
   			$return = array('status' => 500);
        $code = 500;
    	}
    	return $app->json($return, $code);
    });

    return $api;
  }
}
