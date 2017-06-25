<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Silex\Application;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Query\QueryBuilder;
use App\Classes\Configs\Config;
use App\System\Model;

use App\Classes\Cache\MemCacheClient;

Request::enableHttpMethodParameterOverride();

/*
|--------------------------------------------------------------------------
| Load a Static Config Class
|--------------------------------------------------------------------------
*/
$jsonFile = __DIR__ . "/Config.json";
$jsonContent = file_get_contents($jsonFile);
Config::$config = (object) json_decode($jsonContent);

/*
|--------------------------------------------------------------------------
| Application Start
|--------------------------------------------------------------------------
*/
$app = new Application();

/*
|--------------------------------------------------------------------------
| Define a Environment
|--------------------------------------------------------------------------
*/
$env = getenv("ENV") ? strtolower(getenv("ENV")) : "dev";

/*
|--------------------------------------------------------------------------
| Define a Environment - Use TRUE for development and FALSE to production
|--------------------------------------------------------------------------
*/
$app['debug'] = Config::$config->db->$env->debug;


/*
|--------------------------------------------------------------------------
| Twig Register - Is commented for Default. 
|--------------------------------------------------------------------------
*/
// $app->register(new Silex\Provider\TwigServiceProvider(), array(
//   "twig.path" => __DIR__ . "../../src/Views",
//   "twig.form.templates"=>array('form_div_layout.html.twig',"form/form_div_layout.twig"),
//   'twig.options' => array('cache' => '../../tmp/twig', 'strict_variables' => false)
// ));

/*
|--------------------------------------------------------------------------
| Doctrine Config - Register a Simple MySQL Connection
|--------------------------------------------------------------------------
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

/*
|--------------------------------------------------------------------------
| Create a HTTP Cache
|--------------------------------------------------------------------------
*/
$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => '../Storage/Cache/',
    'http_cache.esi'       => null,
));

/*
|--------------------------------------------------------------------------
| Token Provider Database Register - Is used to another methods withou JWT
|--------------------------------------------------------------------------
*/
$app->register(new App\Providers\TokenAuthProvider(), array(
  'token.db' => $app['db']
));

/*
|--------------------------------------------------------------------------
| Middleware - Application/JSON
|--------------------------------------------------------------------------
*/
$app->before(function (Request $request) {
    if (0 === strpos(strtolower($request->headers->get('Content-Type')), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

/*
|--------------------------------------------------------------------------
| Middleware - Pretty printing all JSON output in Silex PHP
|--------------------------------------------------------------------------
*/
$app->after(function(Request $request, Response $response) {
    if($response instanceof JsonResponse) {
        $response->setEncodingOptions(JSON_PRETTY_PRINT);
    }
    return $response;
});

/*
|--------------------------------------------------------------------------
| Convert 404 Errors in JSON 
|--------------------------------------------------------------------------
*/
$app->error(function (NotFoundHttpException $e, Request $request, $code) use ($app) {
  $code = ($e->getCode() > 0) ? $e->getCode() : 404;
  $error = array("msg" => $e->getMessage(), 'status' => $code);
  return $app->json($error, $code);
});

/*
|--------------------------------------------------------------------------
| Convert 500 Errors in JSON 
|--------------------------------------------------------------------------
*/
$app->error(function (\Exception $e, Request $request, $code) use ($app) {
  $code = ($e->getCode() > 0) ? $e->getCode() : 500;
  $error = array("msg" => $e->getMessage(), 'status' => $code);
  return $app->json($error, $code);
});

/*
|--------------------------------------------------------------------------
| QueryBuilder Instance for a Model Abstract Class
|--------------------------------------------------------------------------
*/
Model::$db = $app['db'];
Model::$query = new QueryBuilder($app['db']);

/*
|--------------------------------------------------------------------------
| Memcached Client - Commented by Default
|--------------------------------------------------------------------------
*/
// MemCacheClient::$host = Config::$config->memcache->host;
// MemCacheClient::$port = Config::$config->memcache->port;

/*
|--------------------------------------------------------------------------
| Routes Configs
|--------------------------------------------------------------------------
*/
require __DIR__ . "/Routes.php";

return $app;
