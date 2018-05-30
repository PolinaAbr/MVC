<?php

use polinaframework\Router;

$path = rtrim($_SERVER['QUERY_STRING'], '/');
define('APP', dirname(__DIR__) . '/app');
define('ROOT', dirname(__DIR__));

//require '../polinaframework/router.php';
require '../polinaframework/libs/functions.php';

spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\' , '/', $class) . '.php';
    if (is_file($file)) {
       require_once $file;
    }
});

Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);
//default routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

debug(Router::getRoutes());

Router::dispatch($path);