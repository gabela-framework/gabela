<?php
session_start();

// Include core functions
require_once __DIR__ . '/core/functions.php';

// Include Composer's autoload file
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables from .env file
$rootDir = __DIR__ . '/..';
$dotenv = Dotenv\Dotenv::createImmutable($rootDir);
$dotenv->load();

// Include required paths configuration
require_once __DIR__ . '/config/RequiredPaths.php';

// Include additional vendor files
getIncluded('gabela/helper/vendorFilesIncludes.php');

// Load configuration settings
$config = include BASE_PATH . '/gabela/config/config.php';

// Define base URL and extension path constants
define('BASE_URL', getSiteUrl());
define('EXTENTION_PATH', $config["path"]["additionalPath"]);

// Import necessary classes
use Gabela\Core\EventDispatcher;
use GeoNames\Client as GeoNamesClient;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

// Create the logger instance
$logger = new Logger('gabela-logs');
// Add a handler to the logger
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

// Create an instance of the GeoNames client
$geo = new GeoNamesClient('maneza');

// Create an instance of the EventDispatcher
$dispatcher = new EventDispatcher();
