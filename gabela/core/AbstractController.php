<?php

namespace Gabela\Core;

/**
 * Abstract base class for controllers.
 */
abstract class AbstractController
{

    /**
     * Get Template path
     *
     * @param string $path
     * @return string
     */
    protected function getTemplate($templatePath): void
    {
        if (file_exists($templatePath)) {
            include_once $templatePath;
        } else {
            // Log or display an error message
            printValue("Template not found: $templatePath");
        }
    }

    /**
     * Render a template.
     *
     * @param string $template
     * @param array $data
     */
    protected function renderTemplate($template, $data = [])
    {
        // Check if the template file exists
        if (!file_exists($template)) {
            throw new \Exception("Template file '$template' not found");
        }

        // Extract data variables
        extract($data, EXTR_SKIP);

        // Start output buffering to capture any errors during template execution
        ob_start();

        try {
            // Include the template file
            include ($template);
        } catch (\Throwable $e) {
            // Clean the output buffer
            ob_end_clean();

            // Log the error
            error_log("Error rendering template '$template': " . $e->getMessage());

            // Print the error to the screen for debugging purposes
            echo "Error rendering template '$template': " . $e->getMessage();

            // Re-throw the exception to propagate it further
            throw $e;
        }
    }

    /**
     * Load a controller based on configuration.
     *
     * @param string $controller
     * @return string
     * @throws \Exception
     */
    public function loadController($controller)
    {
        $config = getIncluded('/gabela/config/ControllerConfig.php');

        if (array_key_exists($controller, $config)) {
            $controllerData = $config[$controller];

            require $controllerData['path'] . $controller . '.php';

            return $controllerData['namespace'] . $controller;
        }

        // Handle the case when the controller is not found in the configuration
        throw new \Exception("Controller not found in configuration: {$controller}");
    }
}