<?php

$requestOrigin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : 'unknown origin';


$allowedOrigins = [
    'https://mortalitycore.com',
    'https://www.mortalitycore.com',
    'unknown origin',
];

if (in_array($requestOrigin, $allowedOrigins)) {
    
    error_log("IN ARRAY");
    error_log(print_r($requestOrigin, true));
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


header('Content-Type: application/json');

require_once '../../../keys/storage.php'; 

try {
    $stmt = $pdo->prepare("
        SELECT products.id, products.name, downloads.download_link 
        FROM products 
        LEFT JOIN downloads 
        ON products.id = downloads.product_id
    ");

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['products' => $result]);

} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
