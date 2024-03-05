<?php

use Gabela\Core\Response;

/**
 * Dump and Die function for debugging
 *
 * @param mixed $value
 * @return void
 */
function dd($value)
{
    printValue('<pre>');
    var_dump($value);
    printValue('</pre>');

    die;
}

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
 * @return void
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
