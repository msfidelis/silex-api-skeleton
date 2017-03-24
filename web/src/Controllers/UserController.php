<?php
namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;

use App\Models\Entity\User;
use App\Models\UserModel;

/**
 * Controller de usuário - Exemplo de autenticação
 */
class UserController implements ControllerProviderInterface {

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
		
		$user = $app['controllers_factory'];

		/**
		 * POST - Create User
		 */
		$user->post('/', function(Request $request) use ($app) {

            $user = new User($request->request->all());

            /**
             * Generate a Unique Token for User
             */
            $user->generateToken();
            $user->generatePasswordHash();

            $userModel = new UserModel();
            $newUser = $userModel->save($user);
			return $app->json($newUser, 201);
		});

        /**
         * PUT - Modify User
         */
		$user->put('/{id}', function(Request $request, $id) use ($app) {

            $model = new UserModel();
            $userData = $model->findrow((int) $id);
            $user = new User($userData);
            
             if ($request->request->get('pass')) {
               $user->generatePasswordHash();  
             }

             if ($model->update($id, $user->getValues())) {
                #return $app->json($user->getValues(), 202);
             } else {
                #return $app->json(['msg' => 'erro ao atualizar o usuário'], 500);
             }

             return $app->json($model->findrow($id));

		});


		return $user;
	}


}
