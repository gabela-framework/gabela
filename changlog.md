+ Added a CLI function to create a controller php bin/create-controller.php MyController
+ Chage the controller setup to a config to list all controllers and its paths
+ Adding controller cli to add configuration to router.php file and ControllerConfig file the command will be `php bin/create-controller.php Person` that will create the controllers/PersonController.php file and add `"{$extensionPath}/" => "PersonController::Action",` in the router.php also
 ```    'LoginController' => [
        'namespace' => 'Controller\\',
        'path' => BASE_PATH . '/controllers/',
    ],
```
in the `config/ControllerConfig.php` file

+ Implimenting the event listner for sending emails to new users
+ Added an arguement in the CLI for when we don't want to add router configs when creating controllers using command-line `Usage: php bin/create-controller.php ControllerName --no-config`
+ Added the sweetAlert2 JS lib to have nice UI 
+ Moved the weather API key to a config file

+ Adding maddleware and session for user authentication changed the routing system
