<?php

session_start();





if (isset($_SESSION["useruid"])) {

    if ($_SESSION["permissions"] === "SPECIAL") {
  

if (isset($_POST["deleteid"])) {


    if ($_POST["deleteid"]) {



        
$deleteid = $_POST["deleteid"];



        $foundquery= true;

        
require_once '../../keys/storage.php';


$sql = 'DELETE FROM `builds` WHERE `id` = "'.$deleteid.'"';

$stmt = $pdo->prepare($sql);
$stmt->execute();

header("location: ../addbuild.php?error=succeed");

    } else {
    header("location: ../addbuild.php?error=emptyinput1");
    
    exit();
        }
    }
}
}

