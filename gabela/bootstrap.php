<?php

session_start();

require_once __DIR__ . '/core/functions.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config/RequiredPaths.php';

getIncluded('gabela/helper/vendorFilesIncludes.php');

$config = include BASE_PATH . '/gabela/config/config.php';

define('BASE_URL', getSiteUrl());
define('EXTENTION_PATH', $config["path"]["additionalPath"]);

// use League\Event\EventDispatcher;
use Gabela\Core\EventDispatcher;
use GeoNames\Client as GeoNamesClient;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

// Create the logger
$logger = new Logger('gabela-logs');
// Now add some handlers
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

$geo = new GeoNamesClient('maneza');

// Create an instance of the EventDispatcher
$dispatcher = new EventDispatcher();
