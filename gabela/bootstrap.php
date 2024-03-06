<?php

session_start();

require_once  __DIR__ . '/core/functions.php';
require_once  __DIR__ . '/../vendor/autoload.php';
require_once  __DIR__ .'/config/RequiredPaths.php';

getIncluded('gabela/helper/vendorFilesIncludes.php');

$config = include BASE_PATH . '/gabela/config/config.php';

define('BASE_URL', getSiteUrl());
define('EXTENTION_PATH', $config["path"]["additionalPath"]); 

use Monolog\Logger;
use League\Event\EventDispatcher;
use League\Event\ListenerPriority;
use Monolog\Handler\StreamHandler;
use GeoNames\Client as GeoNamesClient;
use Gabela\Core\Events\EmailSenderListener;
use Gabela\Controller\EmailSenderController;
use League\Event\PrioritizedListenerRegistry;
use Gabela\Core\Events\NewUserRegisteredEvent;

// Create the logger
$logger = new Logger('gabela-logs');
// Now add some handlers
$logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

$geo = new GeoNamesClient('maneza');

// Create an instance of the listener registry
$listenerRegistry = new PrioritizedListenerRegistry();

$dispatcher = new EventDispatcher($listenerRegistry);

// Create an instance of the listener and pass EmailSenderController
$listener = new EmailSenderListener(new EmailSenderController());

// Subscribe to the event with the listener and priority
$dispatcher->subscribeTo(NewUserRegisteredEvent::class, $listener, ListenerPriority::NORMAL);
