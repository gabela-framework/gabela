<?php

namespace Gabela\Core\Middleware;

use Gabela\Core\Response;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Authenticated
{
    public function handle()
    {

        // Create the logger
        $logger = new Logger('Authenticated');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

        if (!isset($_SESSION['user_id'])) {
            $logger->critical('[Permission Denied]: User with no access rights tried to access an unauthorized page');
            redirect('/');
            exit();
        }
    }
}
