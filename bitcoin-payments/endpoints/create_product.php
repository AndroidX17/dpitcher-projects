<?php 
$requestOrigin = $_SERVER['HTTP_ORIGIN'];

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
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../../../keys/storage.php'; 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$target_dir = "/home2/onelayer/public_html/uploads/";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stock = $_POST['stock'];

    $image = $_FILES['image'];

    if (!empty($image)) {
        $target_file = $target_dir . basename($image['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($image['size'] > 500000) { 
            echo json_encode([
                "status" => "error",
                "message" => "File is too large"
            ]);
            exit();
        }

   
        if (file_exists($target_file)) {
            echo json_encode([
                "status" => "error",
                "message" => "File already exists"
            ]);
            exit();
        }

        if ($imageFileType !== 'jpg' && $imageFileType !== 'png' && $imageFileType !== 'jpeg' && $imageFileType !== 'gif') {
            echo json_encode([
                "status" => "error",
                "message" => "Only JPG, JPEG, PNG & GIF files are allowed"
            ]);
            exit();
        }

        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            $image_url = 'https://mortalitycore.com/uploads/' . basename($image['name']);

        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Failed to upload image"
            ]);
            exit();
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "No image uploaded"
        ]);
        exit();
    }

    
    $data = ['name' => $name, 'description' => $description, 'price' => $price, 'image_url' => $image_url, 'stock' => $stock]; // Add stock to data array
    createProduct($conn, $data);
}

function createProduct($conn, $data) {
    $sql = "INSERT INTO products (name, description, price, image_url, stock) VALUES (?, ?, ?, ?, ?);"; // Add stock to SQL query
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to prepare statement"
        ]);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssdsi", $data['name'], $data['description'], $data['price'], $data['image_url'], $data['stock']); // Add stock to bind_param
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_affected_rows($stmt) > 0){
        echo json_encode([
            "status" => "success",
            "message" => "Product created successfully"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to create product"
        ]);
    }

    mysqli_stmt_close($stmt);
}






















?>
