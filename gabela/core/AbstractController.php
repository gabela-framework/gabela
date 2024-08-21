<?php

namespace Gabela\Core;

use Exception;

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
     * @param string $template template path where the view is kept
     * @param array $data additional data to use inside the template
     * 
     * @throws Exception
     * 
     * @return string page template as a path string
     */
    protected function renderTemplate($template, $data = [])
    {
        // Check if the template file exists
        if (!file_exists($template)) {
            throw new Exception("Template file '$template' not found");
        }

        // Extract data variables
        extract($data, EXTR_SKIP);

        // Start output buffering to capture any errors during template execution
        ob_start();

        try {
            // Include the template file
            return include($template);
        } catch (Exception $e) {
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

    /**
     * Render a table with headers and data.
     *
     * @param array $data Array of table rows, where each row is an associative array of column values.
     * @param array $headers Array of table headers, where each header is either a string or an associative array with 'label' and 'attributes'.
     * @param array $options Array of table attributes (e.g., 'class', 'id').
     * 
     * @return string HTML representation of the table.
     */
    protected function renderTable(array $data, array $headers, array $options = []): string
    {
        // Start the table
        $tableHtml = '<table';

        // Add any table options 
        foreach ($options as $key => $value) {
            $tableHtml .= " $key=\"$value\"";
        }

        $tableHtml .= '>';

        // Generate the table headers
        $tableHtml .= '<thead><tr>';
        foreach ($headers as $header) {
            if (is_array($header)) {
                // If the header is an array, it should contain 'label' and 'attributes'
                $label = $header['label'] ?? '';
                $attributes = $header['attributes'] ?? [];

                $headerHtml = '<th';
                foreach ($attributes as $attrKey => $attrValue) {
                    $headerHtml .= " $attrKey=\"$attrValue\"";
                }
                $headerHtml .= ">$label</th>";

                $tableHtml .= $headerHtml;
            } else {
                // If the header is a string, just output it directly
                $tableHtml .= "<th>$header</th>";
            }
        }
        $tableHtml .= '</tr></thead>';

        // Generate the table body
        $tableHtml .= '<tbody>';
        foreach ($data as $row) {
            $tableHtml .= '<tr>';
            foreach ($row as $cell) {
                $tableHtml .= "<td>$cell</td>";
            }
            $tableHtml .= '</tr>';
        }
        $tableHtml .= '</tbody>';

        // End the table
        $tableHtml .= '</table>';

        return $tableHtml;
    }



    /**
     * Render a form with input fields and optional submit button.
     *
     * @param array $fields Array of fields with type, name, and optional value/attributes.
     * @param string $action The form action URL.
     * @param string $method The form method (GET or POST).
     * @param bool $includeSubmit Whether to include a submit button.
     * @param array $formAttributes Optional HTML attributes for the form element.
     * 
     * @return string The generated HTML form.
     */
    protected function renderForm(array $fields, string $action, string $method = 'POST', bool $includeSubmit = true, array $formAttributes = []): string
    {
        $formAttrs = $this->renderAttributes($formAttributes);
        $html = "<form action='" . htmlspecialchars($action) . "' method='" . htmlspecialchars($method) . "' {$formAttrs}>\n";

        foreach ($fields as $field) {
            $type = $field['type'] ?? 'text';
            $name = htmlspecialchars($field['name']);
            $label = htmlspecialchars($field['label'] ?? ucfirst($name));

            // Ensure value is a string or an empty string
            $value = isset($field['value']) && is_string($field['value']) ? htmlspecialchars($field['value']) : '';
            $attrs = $this->renderAttributes($field['attributes'] ?? []);

            $html .= "<div class='form-group'>\n";
            $html .= "<label for='{$name}'>{$label}</label>\n";

            switch ($type) {
                case 'select':
                    $html .= "<select name='{$name}' {$attrs}>\n";
                    foreach ($field['options'] as $option) {
                        $optionValue = htmlspecialchars($option['value']);
                        $optionLabel = htmlspecialchars($option['label']);
                        $selected = ($optionValue == $value) ? 'selected' : '';
                        $html .= "<option value='{$optionLabel}' {$selected}>{$optionLabel}</option>\n";
                    }
                    $html .= "</select>\n";
                    break;

                case 'textarea':
                    $textareaValue = is_string($field['value'] ?? '') ? htmlspecialchars($field['value']) : '';
                    $html .= "<textarea name='{$name}' {$attrs}>{$textareaValue}</textarea>\n";
                    break;

                case 'checkbox':
                    $checked = !empty($field['value']) ? 'checked' : '';
                    $html .= "<input type='checkbox' name='{$name}' value='1' {$checked} {$attrs} />\n";
                    break;

                default:
                    $html .= "<input type='{$type}' name='{$name}' value='{$value}' {$attrs} />\n";
                    break;
            }

            $html .= "</div>\n";
        }

        if ($includeSubmit) {
            $html .= "<div class='form-group'>\n";
            $html .= "<button type='submit' class='btn btn-primary'>Submit</button>\n";
            $html .= "</div>\n";
        }

        $html .= "</form>\n";

        return $html;
    }

    /**
     * Handle form submission and validate required fields.
     *
     * @param array $requiredFields Array of required field names.
     * @param array $postData The submitted data to validate.
     * 
     * @return array|null An array of errors if validation fails, or null if validation passes.
     */
    protected function validateForm(array $requiredFields, array $postData): ?array
    {
        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($postData[$field])) {
                $errors[$field] = ucfirst($field) . " is required.";
            }
        }

        return empty($errors) ? null : $errors;
    }

    /**
     * Render HTML attributes from an associative array.
     *
     * @param array $attributes Associative array of attributes (e.g., ['class' => 'table', 'id' => 'myTable']).
     * 
     * @return string A string of HTML attributes.
     */
    protected function renderAttributes(array $attributes): string
    {
        $attrs = [];

        foreach ($attributes as $key => $value) {
            $attrs[] = htmlspecialchars($key) . '="' . htmlspecialchars($value) . '"';
        }

        return implode(' ', $attrs);
    }


    protected function renderLink(string $url, string $label, array $attributes = []): string
    {
        $attr = $this->renderAttributes($attributes);
        return "<a href='" . htmlspecialchars($url) . "' {$attr}>" . htmlspecialchars($label) . "</a>";
    }

    protected function renderButton(string $label, string $onClick, array $attributes = []): string
    {
        $attr = $this->renderAttributes($attributes);
        return "<button onclick='{$onClick}' {$attr}>" . htmlspecialchars($label) . "</button>";
    }
}
