<?php

require __DIR__ . "/../../vendor/autoload.php";

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Query\QueryBuilder;
use App\Classes\Configs\Config;
use App\System\Model;

use App\Classes\Cache\MemCacheClient;

Request::enableHttpMethodParameterOverride();

/**
* Gera o Static da Config
* @var [type]
*/
$jsonFile = __DIR__ . "/Config.json";
$jsonContent = file_get_contents($jsonFile);
Config::$config = (object) json_decode($jsonContent);

/**
* [$app description]
* @var Application
*/
$app = new Application();

/**
* Pega a varivável de ambiente que define em qual
* environment estamos.
* @var [type]
*/
$env = getenv("ENV") ? strtolower(getenv("ENV")) : "dev";
$app['debug'] = Config::$config->db->$env->debug;

/**
* Debug Method
*/
$app['debug'] = Config::$config->env->debug;


/**
* Configura o Twig
*/
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  "twig.path" => __DIR__ . "../../src/Views",
  "twig.form.templates"=>array('form_div_layout.html.twig',"form/form_div_layout.twig"),
  'twig.options' => array('cache' => '../../tmp/twig', 'strict_variables' => false)
));

/**
* Setup do banco de dados. Esses parâmetros são configurados no arquivo
* src/Configs/Config.json
*/
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
  'db.options' => array(
    'driver'    => Config::$config->db->$env->driver,
    'host'      => Config::$config->db->$env->host,
    'port'      => Config::$config->db->$env->port,
    'dbname'    => Config::$config->db->$env->schema,
    'user'      => Config::$config->db->$env->user,
    'password'  => Config::$config->db->$env->password
  ),
));

/**
 * Middlewares - Auth Token
 */
$app->register(new App\Providers\TokenAuthProvider(), array(
  'token.db' => $app['db']
));

/**
* error Vai customizar a devolução de erros das Exceptions em formato JSON
*/
$app->error(function (\Exception $e, Request $request, $code) use ($app) {
  $error = array("msg" => $e->getMessage(), 'status' => $code);
  return $app->json($error, $code);
});

//Instancia um QueryBuilder genérico. Será utilizado na classe Model
Model::$db = $app['db'];
Model::$query = new QueryBuilder($app['db']);

//Configuração do servidor de Memcache
MemCacheClient::$host = Config::$config->memcache->host;
MemCacheClient::$port = Config::$config->memcache->port;

require __DIR__ . "/Routes.php";

return $app;
