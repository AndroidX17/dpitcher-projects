<?php

$allowed_domains = ['https://mortalitycore.com', 'https://www.mortalitycore.com'];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_domains)) {
  header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../../../keys/storage.php'; 
require_once '../../vendor/autoload.php';


use Denpa\Bitcoin\Client as BitcoinClient;
$bitcoind = new BitcoinClient($specialbitcoin2); 

$rawData = file_get_contents("php://input");


$data = json_decode($rawData);

$userId = $data->userId ?? null;
$depositAddress = $data->depositAddress ?? null;

if ($userId !== null && $depositAddress !== null) {

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("INSERT INTO deposit_addresses (user_id, deposit_address, address_index) VALUES (?, ?, ?)");

  $stmt->bind_param("isi", $userId, $depositAddress, $userId);


if ($stmt->execute()) {
  echo json_encode(['status' => 'success', 'message' => "Successfully inserted deposit address: {$depositAddress} for user ID: {$userId}"]);

  try {
    $bitcoind->importaddress($depositAddress, "watchonly", false);
   
  } catch (Exception $e) {

    error_log($e->getMessage());
  }

} else {
  echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}



  
  // Close statement and connection
  $stmt->close();
  $conn->close();
} else {
  echo json_encode(['status' => 'error', 'message' => 'Missing user ID or deposit address']);
}
?>
