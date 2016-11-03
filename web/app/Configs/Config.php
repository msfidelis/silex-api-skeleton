<?php

define('ROOT',dirname(__DIR__));
require __DIR__ . "/../../vendor/autoload.php";

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Query\QueryBuilder;
use App\System\Model;

Request::enableHttpMethodParameterOverride();

$app = new Application();
$app['debug'] = True;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
  "twig.path" => __DIR__ . "../../src/Views",
  "twig.form.templates"=>array('form_div_layout.html.twig',"form/form_div_layout.twig"),
  'twig.options' => array('cache' => '../../tmp/twig', 'strict_variables' => false)
  )
);

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
      'driver'    => 'pdo_pgsql',
      'host'      => 'PostgreSQL',
      'dbname'    => 'pgdb',
      'user'      => 'pguser',
      'password'  => 'pgpass'
    ),
));

Model::$db = $app['db'];
Model::$query = new QueryBuilder($app['db']);

require __DIR__ . "/Routes.php";


return $app;