![gabela logo](https://github.com/gabela-framework/gabela/assets/161472830/d3513f4b-da42-4126-b923-78839d9f87c8)

# Gabela Framework

Gabela is a lightweight PHP framework designed to simplify web application development. It follows the MVC (Model-View-Controller) architecture and provides essential tools for building scalable and maintainable applications. This framework is crafted to minimize development complexity and offers developers the freedom to choose their preferred templating language, styling framework (e.g., Bootstrap), and jQuery libraries.

## Overview

Gabela aims to strike a balance between simplicity and flexibility. Here are some key features and principles:

- **Flexibility:** Gabela doesn't impose strict conventions, allowing developers to choose their preferred tools and libraries for templating and styling. Use Bootstrap or any other CSS framework that suits your project.

- **Templating Language:** Gabela provides the freedom to use any templating language of your choice. Whether it's plain PHP or a templating engine like Twig, you have the flexibility to structure your views according to your preference.

- **Security Focus:** Gabela places a strong emphasis on user authentication and ongoing security. It includes features and practices that help developers build secure applications, and it is designed to adapt to evolving security standards.

- **Authentication:** The framework simplifies user authentication, making it easy to implement secure login systems and protect sensitive areas of your application.

- **Modular Structure:** Organize your application into modules for better structure and maintainability. Use the `vendor` directory for third-party modules, and create your modules in a modular structure.

- **Freedom of Choice:** Gabela does not restrict developers to a specific set of tools or libraries. It encourages the use of industry-standard components but gives you the freedom to make choices based on your project's requirements.

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

1. Clone the Gabela repository: [https://github.com/your-username/gabela.git](https://github.com/gabela-framework/gabela.git)

    ```bash
    git clone https://github.com/gabela-framework/gabela.git
    ```
    or use composer
```composer
composer create-project gabela/micro-framework
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
$router->get('/', 'HomeController::index')->pass('guest');
$router->post('/submit', 'FormController::submit')->pass('auth');
$router->post('/admin', 'AdminPageController::Index')->pass('admin');
```
The routing for this framework is quit unique and complex yet easy to implement, the drive for the complex routing is the make sure that we cater for the security of your application by implementing the middleware.

## Controllers
-	Controllers handle user requests and invoke the corresponding actions. Create controllers in the controllers directory.
-	In the `gabela\core` you will fine the abstractClass where renderView and getTemplate methods are declared.

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
The 1st module created for the framework as a beta is `gabela-users` which you will get with the framework on the installation. you can also install it using composer.
```sh
composer require gabela/gabela-users
```
You can find the module in the `vendor/gabela/gabela-users`

## Error Handling
Handle errors gracefully using the error handler defined in the ErrorHandler class.

This documentation provides a basic overview of the Gabela framework. Refer to the source code and comments for more detailed information on each component.

For advanced features and customization options, consult the official documentation or the developer community.



## Creating Your First Hello World Page in Gabela Framework
# Step 1: Craft a Controller
Begin by crafting a controller class within the `gabela/controllers` directory. Here's a snippet to create the `HelloWorldController`:

```php
<?php

namespace Gabela\Controller;

class HelloWorldController extends \Gabela\Core\AbstractController
{
    public function Action()
    {
        // Your controller logic goes here
        printValue('Hello World');
    }
}
```

# Step 2: Configure Your Router
In the `router.php` file, configure the routing for your new page:

```php
$router->get("{$extensionPath}/hello-world", "HelloWorldController::Action")->pass('guest');
```

# Step 3: Add Namespace and Path
In the `gabela/config/GabelaPathsConfig.php` file, integrate the namespace and path for your controller:

```php
'HelloWorldController' => [
    'namespace' => 'Gabela\\Controller\\',
    'path' => BASE_PATH . '/gabela/controllers/',
],
```
Now you're all set! Navigate to your page at http://site.local/hello-world and witness your "Hello World" message in action.

## Happy coding with Gabela Framework! 🚀








