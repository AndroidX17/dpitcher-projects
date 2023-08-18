<?php 
$requestOrigin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

if(empty($requestOrigin) && isset($_SERVER['HTTP_REFERER'])) {
    $requestOrigin = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_SCHEME).'://'.parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
}

$allowedOrigins = [
    'https://mortalitycore.com',
    'https://www.mortalitycore.com',
];

if (in_array($requestOrigin, $allowedOrigins)) {
    header("Access-Control-Allow-Origin: $requestOrigin");
} else {

    header('HTTP/1.1 403 Forbidden');
    exit();
}
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

header('Cache-Control: no-store, private, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');  
header('Expires: 0', false);
header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
header ('Pragma: no-cache');


use Firebase\JWT\JWT;
require_once '../../../keys/storage.php'; 
require_once '../../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
   

    $sensitiveData = [
      "seedPhrase" => $specialmention,
    ];

echo json_encode($sensitiveData);
}
