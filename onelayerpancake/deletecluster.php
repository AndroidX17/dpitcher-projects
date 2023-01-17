<?php
session_start();

function deleteFromSearched($addresstodelete, $pdo) {


    $sql2 = 'DELETE FROM `address_helped_cluster` where `address` = :addresstodelete';
    $stmt2 = $pdo -> prepare($sql2);
    $stmt2->bindValue(':addresstodelete', $addresstodelete);
    $stmt2->execute();
    
    
}

try {
   
require_once '../keys/storage.php';


    if (isset($_SESSION["useruid"])) {

    
    $sql = 'DELETE FROM `clusters` where `id` = :id';
$stmt = $pdo -> prepare($sql);
$stmt->bindValue(':id', $_POST['id']);
$stmt->execute();




// needs to also delete all addresses found associated with the cluster

$sql3 = 'SELECT `address` FROM  `addresses_in_clusters` where `clusterkey` LIKE "%'.$_POST['clusterkey'].'%"';

$addressestofulldelete = array();
$resultss = $pdo->query($sql3);
//$result = $pdo->query($sql2);

foreach ($resultss as $resulto) {


    $currentresulto = $resulto['address'];
    array_push($addressestofulldelete, $currentresulto);
}



$sql2 = 'DELETE FROM `addresses_in_clusters` where `clusterkey` = :clusterkey';
$stmt2 = $pdo -> prepare($sql2);
$stmt2->bindValue(':clusterkey', $_POST['clusterkey']);
$stmt2->execute();


$remainders = sizeof($addressestofulldelete);

for ($x=0;$x<$remainders;$x++) {

deleteFromSearched($addressestofulldelete[$x], $pdo);

}




header('location: clustermanager.php?error=success');
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