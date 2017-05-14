<?php
namespace App\Providers;

use Silex\Application;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;


/**
* Provider de Autenticação baseada em Token
* @author Matheus Fidelis
* @email msfidelis01@gmail.com
*/
class TokenAuthProvider implements ServiceProviderInterface, BootableProviderInterface {
    
    /**
    * Register Function
    * @param Container $app
    * @return void
    */
    public function register (Container $app) {
        
        $app['token.db_table'] = 'users';
        $app['token.col_user'] = 'user';
        $app['token.col_pass'] = 'pass';
        $app['token.col_token'] = 'token';
        $app['token.HEADER'] = 'X-AUTH-TOKEN';
        $app['token.cache'] = false;
        $app['token.db'] = null;
        
        /**
        * Clojure - Valida as credenciais no Banco de dados
        */
        $app['validateCredentials'] = $app->protect(
        function($user, $pass) use ($app) {
            
            if (!$user) {
                throw new \Exception("Usuário não informado", 401);
            }
            
            if (!$pass) {
                throw new \Exception("Senha não informada", 401);
            }
            
            $pass = md5(trim($pass));
            $query = "SELECT {$app['token.col_user']} FROM {$app['token.db_table']} WHERE {$app['token.col_user']} = '$user' AND {$app['token.col_pass']} = '$pass'";
            
            $result = $app['token.db']->executeQuery($query);
            
            if (empty($result)) {
                throw new \Exception("Usuário inválido", 401);
            }
            
        });
        
        /**
        * Clojure - Valida o Token informado
        */
        $app['validateToken'] = $app->protect(
        function($token) use ($app) {
            
            if ($app['token.cache']) {
                $auth = $app['token.cache']->get($token);
                if ($auth) {
                    return $auth;
                }
            }
            
            $query = "SELECT * FROM {$app['token.db_table']} WHERE {$app['token.col_token']} = '{$token}' LIMIT 1";
            $result = $app['token.db']->executeQuery($query)->fetchAll();
            
            if (empty($result)) {
                throw new \Exception("Token Inválido", 401);
            }
        }
        );
        
    }
    
    /**
    * Boot Function
    * @param Application $app
    * @return void
    */
    public function boot(Application $app) {
        
    }
}