<?php

/*
|--------------------------------------------------------------------------
| Routes Registering
|--------------------------------------------------------------------------
*/
$app->mount("/", new App\Controllers\IndexController());
$app->mount("/user",new App\Controllers\UserController());

/*
|--------------------------------------------------------------------------
| V1 - Routes
|--------------------------------------------------------------------------
*/
$app->mount("/v1/server",new App\Controllers\v1\ServerController());

$app->mount("/v1/employee",new App\Controllers\v1\EmployeeController());
