<?php

session_start();





if (isset($_SESSION["useruid"])) {

    if ($_SESSION["permissions"] === "SPECIAL") {
  

if (isset($_POST["buildnotes"])) {


    if ($_POST["buildnotes"]) {



        
$buildname = $_POST["buildname"];
$buildlink = $_POST["buildlink"];
$buildnotes = $_POST["buildnotes"];
$tested = $_POST["tested"];

if (isset($_POST["buildlink"])) {


    if ($_POST["buildlink"]) {



        $foundquery= true;

        
require_once '../../keys/storage.php';


$sql = 'INSERT INTO `builds` SET `name` = :dname, `link` = :link, `notes` = :notes;';
//$sql = 'INSERT INTO `builds` SET `name` = :name, `link` = :link, `notes ` = :notes, `tested` = :tested;';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':dname', $buildname);
$stmt->bindValue(':link', $buildlink);
$stmt->bindValue(':notes', $buildnotes);
//$stmt->bindValue(':tested', intval($tested));
$stmt->execute();

header("location: ../addbuild.php?error=succeed");



exit();

} else {

header("location: ../addbuild.php?error=emptyinput6");

exit();
    }
}else {

    header("location: ../addbuild.php?error=emptyinput5");
    
    exit();
        }

    }else {

        header("location: ../addbuild.php?error=emptyinput4");
        
        exit();
            }
}else {

    header("location: ../addbuild.php?error=emptyinput3");
    
    exit();
        }
    }else {

        header("location: ../addbuild.php?error=emptyinput2");
        
        exit();
            }
}else {

    header("location: ../addbuild.php?error=emptyinput1");
    
    exit();
        }

