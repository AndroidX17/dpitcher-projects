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
header("Access-Control-Allow-Methods: GET, POST");

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

$user_id = $_GET['user_id'];

try {

    $stmt = $pdo->prepare("
        SELECT order_items.* 
        FROM order_items 
        INNER JOIN orders ON order_items.order_id = orders.id 
        WHERE orders.user_id = :user_id
    ");

    $stmt->execute([':user_id' => $user_id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if($result) {
        echo json_encode(['purchasedItems' => $result]);
    } else {
        echo json_encode(['purchasedItems' => []]);
    }

} catch(PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
