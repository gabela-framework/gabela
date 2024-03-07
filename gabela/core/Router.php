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
    
                // Check if the controller class has a constructor
                $reflection = new \ReflectionClass($controllerClass);
                
                if ($reflection->hasMethod('__construct')) {
                    $constructor = $reflection->getMethod('__construct');
                    $constructorParameters = $constructor->getParameters();
                    
                    // Check if the constructor has parameters
                    if (!empty($constructorParameters)) {
                        $routeParams = [];
    
                        foreach ($constructorParameters as $param) {
                            // Check if the parameter has a default value
                            if ($param->isDefaultValueAvailable()) {
                                // Use the default value
                                $routeParams[] = $param->getDefaultValue();
                        
                            } else {
                                // Check if the parameter has a type
                                $paramType = $param->getType();
    
                                if ($paramType !== null && !$paramType->isBuiltin()) {
                                    // Use ReflectionClass::getName() to get the class name
                                    $className = $paramType->getName();
                                    // You may need to adjust this part based on how your parameters are determined
                                    $routeParams[] = new $className();
                                } else {
                                    // Handle non-class parameters if needed
                                    $routeParams[] = '';
                                }
                            }
                        }
    
                        // Create an instance of the controller with constructor parameters
                        $controllerInstance = $reflection->newInstanceArgs($routeParams);
                    } else {
                        // Create an instance of the controller without constructor parameters
                        $controllerInstance = new $controllerClass();
                    }
                } else {
                    // Create an instance of the controller without a constructor
                    $controllerInstance = new $controllerClass();
                }
    
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
