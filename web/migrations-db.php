<?php
/**
* Pega a variável de ambiente do projeto
* @var [type]
*/
$env = getenv("ENV") ? strtolower(getenv("ENV")) : "local";
/**
* Pega do arquivo de configuração um objeto com as configurações
* da database correta para o ambiente que está sendo executado
* @var [type]
*/
$jsonFile = __DIR__ . "/src/Configs/Config.json";
$config = (object) json_decode(file_get_contents($jsonFile));
$db = $config->db->$env;

/**
 * Options das Migrations
 */
return array(
        'host'      => $db->host,
        'port'      => $db->port,
        'driver'    => $db->driver,
        'charset'   => $db->charset,
        'dbname'    => $db->schema,
        'user'      => $db->user,
        'password'  => $db->user,
        'defaultTableOptions' => [ 'charset'=> $db->charset, 'collate' =>$db->collate],
);
