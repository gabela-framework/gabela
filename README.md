# Gabela Framework

Gabela is a lightweight PHP framework designed to simplify web application development. It follows the MVC (Model-View-Controller) architecture and provides essential tools for building scalable and maintainable applications with the use of composer to require any libs that you would need.

## Table of Contents

1. [Installation](#installation)
2. [Getting Started](#getting-started)
3. [Configuration](#configuration)
4. [Routing](#routing)
5. [Controllers](#controllers)
6. [Models](#models)
7. [Views](#views)
8. [Helpers](#helpers)
9. [Middleware](#middleware)
10. [Modules](#modules)
11. [Error Handling](#error-handling)

## Installation

1. Clone the Gabela repository:

    ```bash
    git clone https://github.com/your-username/gabela.git
    ```

2. Install dependencies using Composer:

    ```bash
    composer install
    ```

3. Configure your web server to point to the root directory if using apache make sure you change the Base in the .htaccess as required.

## Getting Started

Gabela follows a simple and intuitive structure. The entry point is the `index.php` and also `bootstrap.php` file inside the gabela  directory.

## Configuration

Configuration settings are stored in the `config` directory. Update the `gabela/config/config.php` file to set environment-specific configurations.

## Routing

Define routes in the `router.php` file. Use the `Gabela\Core\Router` class to map URLs to controller actions.

```php
$router->get('/', 'HomeController@index');
$router->post('/submit', 'FormController@submit');
```

## Controllers
Controllers handle user requests and invoke the corresponding actions. Create controllers in the controllers directory.

```php
class HomeController extends ControllerAbstract
{
    public function index()
    {
        $this->getTemplate('home');
    }
}
```

## Models
Models represent the data and business logic of your application. Create models in the models directory.

```php
class User implements UserInterface
{
    // Model methods here
}
```

## Views
Views are stored in the views directory. Use plain HTML or a templating engine for your views.

```html
<!-- views/home.php -->
<html>
<body>
    <h1>Welcome to Gabela Framework</h1>
</body>
</html>

```

## Helpers
Helpers are utility functions that can be used throughout your application. Customize the helpers directory for additional functionality.

```php
// helpers/weatherApi.php
function getCurrentWeather()
{
    // Weather fetching logic
}

```

## Middleware
Middleware provides a convenient mechanism for filtering HTTP requests entering your application. Customize the middleware directory to add middleware.

## Modules
Organize your application into modules for better structure and maintainability. Use the vendor directory for third-party modules.

## Error Handling
Handle errors gracefully using the error handler defined in the ErrorHandler class.

This documentation provides a basic overview of the Gabela framework. Refer to the source code and comments for more detailed information on each component.

For advanced features and customization options, consult the official documentation or the developer community.

* # Happy coding with Gabela Framework!!!






