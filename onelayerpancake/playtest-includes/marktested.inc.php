<?php

session_start();





if (isset($_SESSION["useruid"])) {

    if ($_SESSION["permissions"] === "SPECIAL") {
  

if (isset($_POST["testedid"])) {


    if ($_POST["testedid"]) {



        
$testedid = $_POST["testedid"];



        $foundquery= true;

        
require_once '../../keys/storage.php';

$number = 1;
if ($_POST["testedv"] == "1") {

    $number = 0;
}



$sql = 'UPDATE `builds` SET `tested` = '.$number.' WHERE `id` = "'.$testedid.'";';

$stmt = $pdo->prepare($sql);
$stmt->execute();

header("location: ../playtestportal.php?error=succeed");

    } else {
    header("location: ../playtestportal.php?error=emptyinput1");
    
    exit();
        }
    }
}
}

