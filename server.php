<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

if (strncmp($uri, '/stats/', 7) === 0) {
    $url = 'http://localhost:8001/' . substr($uri, 7);
    if (isset($_SERVER['QUERY_STRING']))
        $url .= '?' . $_SERVER['QUERY_STRING'];
    $session = curl_init($url);
    $request_method = $_SERVER['REQUEST_METHOD'];
    if ($request_method === 'POST') {
        curl_setopt($session, CURLOPT_POST, true);
        curl_setopt($session, CURLOPT_POSTFIELDS, file_get_contents("php://input"));
    } else {
        curl_setopt($session, CURLOPT_CUSTOMREQUEST, $request_method);
    }
    $request_headers = [];
    foreach (getallheaders() as $key => $value)
        $request_headers[] = "$key: $value";
    curl_setopt($session, CURLOPT_HTTPHEADER, $request_headers);
    curl_setopt($session, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_HEADER, true);

    $response = curl_exec($session);
    $header_size = curl_getinfo($session, CURLINFO_HEADER_SIZE);
    $response_body = substr($response, $header_size);
    $response_httpcode = curl_getinfo($session, CURLINFO_HTTP_CODE);
    $response_content_type = curl_getinfo($session, CURLINFO_CONTENT_TYPE);
    $response_error = curl_error($session);
    curl_close($session);

    header("Content-type: $response_content_type", 1);
    http_response_code($response_httpcode);
    echo $response_error ? $response_error : $response_body;

    return true;
}

require_once __DIR__.'/public/index.php';
