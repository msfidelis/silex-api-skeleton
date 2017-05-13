<?php

/*
|--------------------------------------------------------------------------
| Routes Registering
|--------------------------------------------------------------------------
*/
$app->mount("/", new App\Controllers\IndexController());
$app->mount("/api",new App\Controllers\ApiController());
$app->mount("/user",new App\Controllers\UserController());

/*
|--------------------------------------------------------------------------
| V1 - Routes
|--------------------------------------------------------------------------
*/
$app->mount("/v1/server",new App\Controllers\ServerController());
