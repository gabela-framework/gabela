<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

const BASE_PATH = __DIR__;

require BASE_PATH . '/gabela/bootstrap.php';

// Include the updated router
// $router = include 'router.php';
$router = getIncluded('/router.php');
// Copy the current request URI to another variable
$requestUri = $_SERVER['REQUEST_URI'];

// Find the position of '?' in the request URI
$queryPosition = strpos($requestUri, '?');

// Extract the path and query parameters
$cleanRoute = $queryPosition !== false ? substr($requestUri, 0, $queryPosition) : $requestUri;

// Original route with the query string
$route = $requestUri;

try {
    /** @var Gabela\Core\Router $router */
    $router->route($cleanRoute, $_SERVER['REQUEST_METHOD']);
} catch (Exception $e) {
    $logger->critical('Cannot get the targeted controller check the classes and try again', ['exception' => $e]);
    echo('There seem to be issues with the routing check your files and try again');
    var_dump($e);
     $router->previousUrl();
}
