<?php

/*
|--------------------------------------------------------------------------
| Migrations Configs
|--------------------------------------------------------------------------
|
| Parse a JSON file for Migration Database by Environment
|
*/
$env = getenv("ENV") ? strtolower(getenv("ENV")) : "local";

$jsonFile = __DIR__ . "/Configs/Config.json";
$config = (object) json_decode(file_get_contents($jsonFile));
$db = $config->db->$env;

/**
 * Migrations Configis
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
