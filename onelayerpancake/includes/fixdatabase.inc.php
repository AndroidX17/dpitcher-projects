<?php






session_start();



require_once '../../keys/storage.php';


if (isset($_SESSION["useruid"])) {

    if (isset($_POST["FIXDATABASE"])) {




//$sql = "DELETE * FROM `address_helped_cluster` WHERE `address` NOT IN (SELECT `address` FROM `addresses_in_clusters`)";
$sql = "DELETE FROM `address_helped_cluster`
WHERE NOT EXISTS (
  SELECT *
  FROM `addresses_in_clusters`
  WHERE addresses_in_clusters.address = address_helped_cluster.address
)";
$stmt = $pdo -> prepare($sql);
$stmt->execute();




    header("Location: ../clustermanager.php?error=executed"); // go here




    exit();




}
    }









    header("Location: ../clustermanager.php?error=none"); // go here


















