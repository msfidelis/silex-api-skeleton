<?php
namespace App\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Silex\Api\ControllerProviderInterface;

use App\Models\Entity\User;
use App\Models\UserModel;

/**
* Controller de usuário - Exemplo de autenticação
*/
class UserController implements ControllerProviderInterface 
{
    
    /**
    * Connect Method
    * @param Application $app
    * @return Application
    */
    public function connect(Application $app) 
    {
        
        /**
        * Middlewares do controller - Todas as ações desse método
        * serão aplicados em todas as requests efetuadas para o
        * controller
        */
        $app->before(function (Request $request, Application $app) {
            
        });
        
        /**
        * Application Factory
        */
        $user = $app['controllers_factory'];
        
        /**
        * POST - Create User
        * Cria um usuário para a API
        * curl -H "Content-type: application/json" \
        * -d '{"user": "usuário exemplo", "pass":"senha de exemplo"}' \
        * -X POST http://localhost/user/
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
            
            if ($newUser) {
                return $app->json($newUser, 201);
            } else {
                return $app->json(['msg' => 'Não foi possível criar o usuário'], 400);
            }
        });
        
        /**
        * PUT - Atualiza um usuário - Troca senha
        * curl -H "X-AUTH-TOKEN:ecbea4dc787bcc7b2f78cc08ed1c4255" \
        * -d user="matheus" -d pass="123" -X PUT http://localhost/user/58
        */
        $user->put('/{id}', function(Request $request, $id) use ($app) {
            
            $model = new UserModel();
            
            if ($model->update((int) $id, $request->request->all())) {
                return $app->json($model->findrow($id), 202);
            } else {
                return $app->json(['msg' => 'usuário não alterado'], 304);
            }
        })
        /**
        * MIDDLEWARES
        * Valida se o Token informado na chave X-AUTH-TOKEN existe no banco
        */
        ->before(function (Request $request, Application $app) {
            $app['validateToken']($request->headers->get('X-AUTH-TOKEN'));
        });
        
        /**
        * GET - Return a User Token
        * Implemented a HTTP Auth to return this
        */
        $user->get('/{id}/newtoken', function(Request $request, $id) use ($app) {
            
            $model = new UserModel();
            
            $userdata = $model->findrow($id);
            
            if ($userdata) {
                $user = new User($userdata);
                $user->generateToken();
                
                if ($model->update((int) $id, $user->getValues())) {
                    return $app->json(['access_token' => $user->getToken()], 200);
                } else {
                    return $app->json(['msg' => 'Não foi possivel atualizar o usuário'], 400);
                }
                
            } else {
                return $app->json(['msg' => 'usuário não encontrado'], 404);
            }
            
            
        })
        /**
        * Middleware - Valida as credenciar informadas no Header para
        * retornar o Token
        */
        ->before(function (Request $request, Application $app) {
            $app['validateCredentials']($request->headers->get('X-USER'), $request->headers->get('X-PASS'));
        });;
        
        
        return $user;
    }
    
    
}