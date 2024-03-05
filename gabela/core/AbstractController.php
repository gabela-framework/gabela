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
        $templatePath = $this->getTemplate($template);

        if (file_exists($templatePath)) {
            extract($data);
            include $templatePath;
        } else {
            // Handle template not found
            echo "Template not found: $templatePath";
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