<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../../../keys/storage.php'; 

$data = json_decode(file_get_contents("php://input"));

if(isset($data->product_id) && isset($data->new_download_link)) {
    
    $product_id = $data->product_id;
    $new_download_link = $data->new_download_link;

    try {
        $stmt = $pdo->prepare("
            INSERT INTO downloads (product_id, download_link)
            VALUES (:product_id, :new_download_link)
            ON DUPLICATE KEY UPDATE download_link = :new_download_link
        ");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':new_download_link', $new_download_link);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            echo json_encode(['message' => 'Download link updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update download link']);
        }

    } catch(PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }

} else {
    echo json_encode(['message' => 'No product_id or new_download_link provided']);
}

?>
