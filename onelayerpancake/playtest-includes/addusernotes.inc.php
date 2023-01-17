<?php

session_start();





if (isset($_SESSION["useruid"])) {

    if ($_SESSION["permissions"] === "SPECIAL") {
  

if (isset($_POST["testedid"])) {


    if ($_POST["testedid"]) {



        
        $testedid = $_POST["testedid"];
        $usernotes = $_POST["usernotes"];
        $username = $_POST["username"];



        $foundquery= true;

        
require_once '../../keys/storage.php';


$sql = 'INSERT INTO `buildnotes` SET `buildid` = :buildid, `notes` = :notes, `username` = :username;';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':buildid', $testedid);
$stmt->bindValue(':notes', $usernotes);
$stmt->bindValue(':username', $username);
$stmt->execute();









header("location: ../playtestportal.php?error=succeed");

    } else {
    header("location: ../playtestportal.php?error=emptyinput1");
    
    exit();
        }
    }
}
}

