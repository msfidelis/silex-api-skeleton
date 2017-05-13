<?php
require __DIR__.'/vendor/autoload.php';
use Symfony\Component\Console\Application;
$application = new Application();

/*
|--------------------------------------------------------------------------
| Load The Symfony Console Commands
|--------------------------------------------------------------------------
|
| This is a simple implementation for Console Application to use Symfony Migrations
|
*/
$application->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand());
$application->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand());
$application->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand());
$application->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand());
$application->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand());
$application->add(new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand());
$application->run();
