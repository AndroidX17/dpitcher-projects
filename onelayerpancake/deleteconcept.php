<?php
session_start();
try {
   
require_once '../keys/storage.php';


    if (isset($_SESSION["useruid"])) {

    
    $sql = 'DELETE FROM `concepts` where `id` = :id';
$stmt = $pdo -> prepare($sql);
$stmt->bindValue(':id', $_POST['id']);
$stmt->execute();

header('location: viewconcept.php');
    } else {
        echo 'not logged in';
    }

} 
 catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' .
$e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/templates/layout.html.php';

?>