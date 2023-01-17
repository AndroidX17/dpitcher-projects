<?php






session_start();



require_once '../../keys/storage.php';


if (isset($_SESSION["useruid"])) {

    if (isset($_POST["CLEANDATABASE"])) {




//$sql = "DELETE * FROM `address_helped_cluster` WHERE `address` NOT IN (SELECT `address` FROM `addresses_in_clusters`)";
$sql = 'DELETE FROM `addresses_in_clusters` WHERE `clusterkey` = "-1";';
$stmt = $pdo -> prepare($sql);
$stmt->execute();




    header("Location: ../clustermanager.php?error=executed"); // go here




    exit();




}
    }









    header("Location: ../clustermanager.php?error=none"); // go here


















