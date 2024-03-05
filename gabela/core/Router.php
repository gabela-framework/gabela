<?php

namespace Gabela\Core;

use Gabela\Core\AbstractController;
use Gabela\Core\Middleware\Middleware;

class Router extends AbstractController
{
    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
        ];

        return $this;
    }

    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function pass($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && strtoupper($route['method']) === strtoupper($method)) {
                // Check if middleware is specified and resolve it
                if (!empty($route['middleware'])) {
                    Middleware::resolve($route['middleware']);
                }

                // Extract controller and method from the route
                [$controllerClass, $method] = explode('::', $route['controller']);

                $controllerClass = $this->loadController($controllerClass);

                $requestUri = $_SERVER['REQUEST_URI'];

                // Find the position of '?' in the request URI
                $queryPosition = strpos($requestUri, '?');

                // Extract the path and query parameters

                $queryParams = [];

                // Extract parameters from query string if they are required
                if ($queryPosition !== false) {
                    parse_str(substr($requestUri, $queryPosition + 1), $queryParams);
                }

                // Pass $queryParams to the method
                $controllerInstance = new $controllerClass();

                // Call the specified method
                if (method_exists($controllerInstance, $method)) {
                    $controllerInstance->$method();
                } else {
                    $this->abort();
                }

                // Exit the loop after processing the route
                return;
            }
        }

        $this->abort();
    }

    public function previousUrl()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            return $_SERVER['HTTP_REFERER'];
        } else {
            $this->abort();
        }
    }

    protected function abort($code = 404)
    {
        http_response_code($code);

        getRequired("gabela/views/{$code}.php");

        die();
    }
}
