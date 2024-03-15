<?php

namespace Gabela\Core\Middleware;

use Gabela\Core\Router;
use Gabela\Core\Middleware\Guest;
use Gabela\Core\Middleware\Authenticated;
use Gabela\Core\Middleware\RoleMiddleware;
use Gabela\Core\Exception\GabelaInvalidRequestException;

class Middleware
{
    public const MAP = [
        'guest' => Guest::class,
        'auth' => Authenticated::class,
        'admin' => RoleMiddleware::class,
    ];

    private static $router;

    public static function setRouter(Router $router)
    {
        self::$router = $router;
    }

    /**
     * resolve the middleware
     *
     * @param string $key the auth router admin, guest, or auth
     * @return void
     */
    public static function resolve($key)
    {
        if (!$key) {
            return;
        }

        $middleware = self::MAP[$key] ?? false;

        if (!$middleware) {
            throw new GabelaInvalidRequestException("No matching middleware found for key '{$key}'.");
        }

        (new $middleware(self::$router))->handle();
    }
}
