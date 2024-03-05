<?php
const BASE_PATH = __DIR__;

require __DIR__ . "/../gabela/core/functions.php";
require __DIR__ . "/../vendor/autoload.php";
// getRequired('vendor/autoload.php');

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$logger = new Logger('CLI-CONTROLLER');
$logger->pushHandler(new StreamHandler('var/CLI.log', Logger::DEBUG));

try {
    // Check if enough arguments are provided
    if ($argc < 2) {
        throw new Exception("Not enough arguments. Usage: php bin/create-controller.php ControllerName");
    }

    if (PHP_SAPI !== 'cli') {
        throw new Exception("bin/create-controller.php must be run as a CLI application");
    }

    // Get the controller name from the command line arguments
    $controllerName = ucfirst($argv[1]) . 'Controller';
    $controllerSubDirs = explode('/', $argv[1]); // split subdirectories

    $lastSubDir = array_pop($controllerSubDirs);
    $controllerNamespace = 'Gabela\Controller';
    $controllerPath = BASE_PATH . '/../gabela/controllers/';

    foreach ($controllerSubDirs as $subDir) {
        $controllerNamespace .= '\\' . $subDir;
        $controllerPath .= $subDir . '/';

        // Create the subdirectory
        if (!file_exists($controllerPath)) {
            mkdir($controllerPath, 0755, true);
        }
    }

    // Adjust controller name to include 'Controller'
    $lastSubDir = ucfirst($lastSubDir) . 'Controller';

    // Reset controller namespace when there are no subdirectories
    if (empty($controllerSubDirs)) {
        $controllerNamespace .= '\\';
    }

    // Create the controller file's content
    $controllerContent = <<<PHP
                <?php

                namespace $controllerNamespace;

                class $lastSubDir extends \Gabela\Core\AbstractController
                {
                    public function Action()
                    {
                        // Controller method logic
                    }
                }
            PHP;

    file_put_contents($controllerPath . $lastSubDir . '.php', $controllerContent);

    // Output success message
    printValue("===== Controller '$lastSubDir' created successfully! =====\n");
    $logger->info("Controller '$lastSubDir' created successfully!");

    if ($argc >= 3 && $argv[2] === '--no-config') {
        // Output message about skipping config
        printValue("===== Skipping configuration for '$lastSubDir'. =====\n");
    } else {
        // Add the controller configuration to ControllerConfig.php ////////////////////////////////////////////////////
        $configFile = BASE_PATH . '/../gabela/config/GabelaPathsConfig.php';
        $configContent = file_get_contents($configFile);

        $relativePath = implode('/', array_map('ucfirst', $controllerSubDirs));

        if (!empty($controllerSubDirs)) {
            $newConfig = "    '$lastSubDir' => [
                'namespace' => '$controllerNamespace\\\\',
                'path' => BASE_PATH . '/gabela/controllers/$relativePath/',
            ],";
        } else {
            $newConfig = "    '$lastSubDir' => [
                'namespace' => 'Gabela\Controller',
                    'path' => BASE_PATH . '/gabela/controllers/',
                ],";
        }

        // Find the position of the last return statement
        $lastReturnPos = strrpos($configContent, 'return [');
        // Insert the new config after the opening return [
        $configContent = substr_replace($configContent, "\n$newConfig", $lastReturnPos + 8, 0);

        file_put_contents($configFile, $configContent);

        // Output success message
        printValue("===== Controller configuration for '$lastSubDir' added to ControllerConfig.php! add the routers in the router.php =====\n");
        $logger->info("Controller configuration for '$lastSubDir' added to ControllerConfig.php! add the routers in the router.php");

        // ... (previous code)

        // Add the controller routers to router.php
        $routerFile = BASE_PATH . '/../router.php';
        $routerContent = file_get_contents($routerFile);

        // Determine the correct extension path
        $extensionPath = $controllerSubDirs ? implode('/', array_map('lcfirst', $controllerSubDirs)) : '';

        // Adjust the router configuration
        $newRouter = "\$router->get(\"{\$extensionPath}/new-route\", \"{$lastSubDir}::Action\")->pass('guest');\n\n";

        $lastReturnPos = strrpos($routerContent, 'return ');
        $lastReturnBracketPos = strrpos(substr($routerContent, 0, $lastReturnPos), '}');
        $insertPos = max($lastReturnBracketPos, $lastReturnPos);
        // Insert the new config
        $routerContent = substr_replace($routerContent, "\n$newRouter", $insertPos, 0);

        file_put_contents($routerFile, $routerContent);

        printValue("===== Controller configuration for '$lastSubDir' added to router.php! =====\n");
        $logger->info("Controller configuration for '$lastSubDir' added to router.php!");

    }
} catch (Exception $e) {
    printValue("Error: {$e->getMessage()}\n");
    $logger->error("Error: {$e->getMessage()}");
    exit(1);
}
