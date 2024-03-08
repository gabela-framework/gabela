<?php

namespace Gabela\Core\Middleware;

//getRequired(USER_MODEL);

use Gabela\Core\Middleware\Middleware;
use Gabela\Core\Response;
use Gabela\Model\User;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class RoleMiddleware extends Middleware
{
    public function handle()
    {
        // Retrieve the current authenticated user
        $user = User::getCurrentUser();
        $logger = new Logger('Admin-Middleware');
        $logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));

        try {
            if ($user && $user["role"] === 'admin') {
                // User has the 'admin' role, proceed with the next middleware or route handler
                return parent::class;
            } else {
                abort(Response::FORBIDDEN);
            }
        } catch (\Throwable $th) {
            /** @var Logger $logger */
            $logger->critical('An exception occurred', ['exception' => $th]);
        }
    }
}
