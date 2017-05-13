<?php

/*
|--------------------------------------------------------------------------
| Routes Registering
|--------------------------------------------------------------------------
*/
$app->mount("/", new App\Controllers\IndexController());
$app->mount("/employee",new App\Controllers\EmployeeController());
$app->mount("/user",new App\Controllers\UserController());

/*
|--------------------------------------------------------------------------
| V1 - Routes
|--------------------------------------------------------------------------
*/
$app->mount("/v1/server",new App\Controllers\ServerController());
