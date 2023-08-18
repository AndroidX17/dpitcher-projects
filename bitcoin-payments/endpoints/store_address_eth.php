<?php
// store_address_eth.php

$allowed_domains = ['https://mortalitycore.com', 'https://www.mortalitycore.com'];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_domains)) {
  header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once '../../../keys/storage.php'; // grants pdo conn and specialbitcoin2 and specialnotice and specialchain
require_once '../../vendor/autoload.php';


// Get the raw POST data
$rawData = file_get_contents("php://input");

// This returns a standard class object in PHP
$data = json_decode($rawData);

$userId = $data->userId ?? null;
$depositAddress = $data->depositAddress ?? null;

if ($userId !== null && $depositAddress !== null) {
  // Connect to the MySQL database

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare an SQL statement for execution
  $stmt = $conn->prepare("INSERT INTO eth_deposit_addresses (user_id, deposit_address, address_index) VALUES (?, ?, ?)");
 
  // Bind variables to the prepared statement as parameters
  $stmt->bind_param("isi", $userId, $depositAddress, $userId);



  // Execute the prepared statement
  if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => "Successfully inserted deposit address: {$depositAddress} for user ID: {$userId}"]);
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
