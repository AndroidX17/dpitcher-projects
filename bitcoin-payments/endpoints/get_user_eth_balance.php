<?php 
header("Access-Control-Allow-Origin: https://mortalitycore.com");
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

require_once '../../../keys/storage.php'; 

require_once '../../vendor/autoload.php'; 

use \Firebase\JWT\JWT;
error_log("USER ETH BALANCE GO");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $userId = null;
    
    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
    } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $arr = explode(" ", $authHeader);
        
        if (isset($arr[1])) {
            $jwt = $arr[1];

            if ($jwt) {
                try {
                    $decoded = JWT::decode($jwt, $specialphrase, array('HS256'));
                    $userId = $decoded->sub;
                } catch (Exception $e) {
                    http_response_code(401);
                    echo json_encode(array(
                        "message" => "Access denied.",
                        "error" => $e->getMessage()
                    ));
                }
            }
        }
    }
    
    if ($userId !== null) {
        getUserETHBalance($conn, $userId);
    } else {

        http_response_code(400);
        echo json_encode(array(
            "message" => "No user ID was provided.",
        ));
    }
}

function getUserETHBalance($conn, $userId){

      if ($userId === null) {
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode([
            "status" => "error",
            "message" => "Invalid user ID"
        ]);
        exit();
    }
    $sql = 'SELECT eth_balance FROM user_eth_balances WHERE user_id = ?;';
    
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode([
            "status" => "error",
            "message" => "Failed to prepare statement"
        ]);
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($resultData)) {
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode([
            "status" => "success",
            "ethbalance" => $row["eth_balance"]

        ]);
        exit();
    } else {
     
        $sql = 'INSERT INTO user_eth_balances (user_id, eth_balance) VALUES (?, 0.0);';

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Content-Type: application/json; charset=UTF-8");
            echo json_encode([
                "status" => "error",
                "message" => "Failed to prepare statement"
            ]);
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);

        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode([
            "status" => "success",
            "message" => "New user balance entry created",
            "ethbalance" => 0.0
        ]);
        exit();
    }
    
    mysqli_stmt_close($stmt);
}
?>
