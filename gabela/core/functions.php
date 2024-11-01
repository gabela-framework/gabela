<?php

use Gabela\Core\Response;

/**
 * include function with the limited project roor path.
 *
 * @param string $path
 * @return string
 */
function getRequired($path)
{
    return require BASE_PATH .  '/'. $path;
}


/**
 * Get Templetes in the controller
 *
 * @param string $path
 * @return string
 */
function getTemplate($templatePath): void
{
    if (file_exists($templatePath)) {
        include_once $templatePath;
    } else {
        // Log or display an error message
        printValue("Template not found: $templatePath");
    }
}

/**
 * include function with the limited project roor path.
 *
 * @param string $path
 * @return string
 */
function getIncluded($path)
{
    return include BASE_PATH . '/'. $path;
}

/**
 * Printing function replacing echo
 *
 * @param string $string
 * @return void
 */
function printValue($string)
{
    echo $string;
}

function after($data, $inthat)
{
    if (!is_bool(strpos($inthat, $data)))
        return substr($inthat, strpos($inthat, $data) + strlen($data));
}

/**
 * Get Website URL
 *
 * @param string $path
 * @return string
 */
function getSiteUrl($path = '')
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $scriptName = $_SERVER['SCRIPT_NAME'];

    // Remove the script filename to get the base URL
    $baseUrl = dirname($scriptName);

    // Check if the URL already ends with a slash
    if (substr($baseUrl, -1) !== '/') {
        // Append a slash to the base URL
        $baseUrl .= '/';
    }

    return $protocol . $host . $baseUrl . $path;
}

/**
 * Redict to another path
 *
 * @param string $path
 * @return string
 */
function redirect($path)
{
    $baseUrl = rtrim($_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']), '/');
    header("Location: http://$baseUrl$path");
    exit();
}

/**
 * Base path for uri
 *
 * @param string $path
 * @return string
 */
function base_path($path)
{
    return BASE_PATH . $path;
}

/**
 * Abort 404 error
 *
 * @param integer $code
 * @return void
 */
function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);

    require base_path("/gabela/views/{$code}.php");

    die();
}


if (!function_exists('format_array')) {
    /**format array for pretty print
    *
    * @param $data
    * @param $level
    * @return string
    */
    function format_array($data, $level = 0): string
    {
    $spaces = str_repeat(' ', $level);
    $output = "";
    if (is_array($data) OR is_object($data)) {
    $output = "[\n";
    foreach ($data as $key => $value) {
    $output .= $spaces . ' ' . "<span style='color:#888888;'>[" . htmlspecialchars($key) . "]</span> => ";
    if (is_array($value)) {
    $output .= format_array($value, $level + 1);
    } elseif (is_string($value)) {
    $output .= "<span style='color:green;'>'" . htmlspecialchars($value) . "'</span>";
    } elseif (is_int($value) || is_float($value)) {
    $output .= "<span style='color:blue;'>" . htmlspecialchars($value) . "</span>";
    } elseif (is_bool($value)) {
    $output .= "<span style='color:purple;'>" . ($value ? 'true' : 'false') . "</span>";
    } elseif (is_null($value)) {
    $output .= "<span style='color:red;'>null</span>";
    } else {
    $output .= "<span style='color:orange;'>" . htmlspecialchars(var_export($value, true)) . "</span>";
    }
    $output .= ",\n";
    }
    } else{
    $output .= "[";
    $output .= $data;
    }
    $output .= $spaces . "]";
    return $output;
    }
    }
    /**
    * Dump a nice array|string|int
    *
    * @param $data
    * @return void
    */
    function print_array($data) {
    // Apply the formatting and output
    echo '<pre style="background-color:#f4f4f4; padding:10px; border:1px solid #ddd; border-radius:5px; font-family:monospace;">';
    echo format_array($data);
    echo '</pre>';
    }
    /**
    * Dump Die
    *
    * @param mixed|array $data variable to dump data
    * @return void
    */
    function dd($data) {
    // Apply the formatting and output
    echo '<pre style="background-color:#f4f4f4; padding:10px; border:1px solid #ddd; border-radius:5px; font-family:monospace;">';
    echo format_array($data);
    echo '</pre>';
    die;
    }