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

header('Cache-Control: no-store, private, no-cache, must-revalidate'); // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false); // HTTP/1.1
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Date in the past  
header('Expires: 0', false);
header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
header ('Pragma: no-cache');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); 

error_log("SIGNUP");
error_log("UD:".$_POST["uid"]);

if (isset($_POST["uid"])) {

    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once '../../keys/storage.php';
    
    require_once 'functions.inc.php';

    if (emptyInputSignup($username, $pwd, $pwdRepeat) !== false) {
        echo json_encode(['error' => 'Empty input']);
        exit();
    }

    if (invalidUid($username) !== false) {
        echo json_encode(['error' => 'Invalid username']);
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        echo json_encode(['error' => 'Passwords do not match']);
        exit();
    }

    if (uidExists($conn, $username, $username) !== false) {
        echo json_encode(['error' => 'Username is already taken']);
        exit();
    }
 

    createUserShop($conn, $username, $pwd, $pdo);

    echo json_encode(['success' => 'User created']);
    exit();
} else {
    echo json_encode(['error' => 'No POST data']);
    exit();
}
function createUserShop($conn, $username, $pwd, $pdo) {


    $sql = 'INSERT INTO users (usersUid, usersPwd) VALUES (?,?)';
     $stmt = mysqli_stmt_init($conn);
     
     if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo json_encode(['error' => 'fail insert']);
        die();
     }
     
 $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
 
     mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPwd);
 
 
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
 
 
   
 
                     }
 