<?php

session_start();





if (isset($_SESSION["useruid"])) {

    if ($_SESSION["permissions"] === "SPECIAL") {
  

if (isset($_POST["deleteid"])) {


    if ($_POST["deleteid"]) {



        
        $deleteid = $_POST["deleteid"];
        $deleteuser= $_POST["deleteuser"];

if ($_SESSION["useruid"] == $deleteuser) {



    

    
}

$foundquery= true;


require_once '../../keys/storage.php';


$sql = 'DELETE FROM `buildnotes` WHERE `id` = "'.$deleteid.'"';

$stmt = $pdo->prepare($sql);
$stmt->execute();

header("location: ../playtestportal.php?error=succeed");


    } else {
        header("location: ../playtestportal.php?error=emptyinput21");
        
        exit();
            }
    } else {
    header("location: ../playtestportal.php?error=emptyinput1");
    
    exit();
        }
    }
}

