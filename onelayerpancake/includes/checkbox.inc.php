<?php

session_start();

require_once '../../keys/storage.php';

if (isset($_SESSION["useruid"])) {
    $check1 = $_POST["Check1"];

   // require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

if ($check1 === "on") {

$currentdude = $_SESSION["useruid"];




  require_once '../../keys/storage.php';
    $sql = 'SELECT `username`,`has_pancake` FROM `user_has_pancake`';
        
    $result = $pdo->query($sql);
$hadpermissions = false;
      // $sql2 = 'SELECT `concept` FROM `concepts`';
$currentloggedinuser = $_SESSION["useruid"];
$foundmatch = false;
foreach ($result as $row) {
  $stuff = $row['username'];
  if ($stuff === $currentloggedinuser) {
$foundmatch = true;
$hadpermissions = $row['has_pancake'];
  }

        }

        if ($foundmatch === false) {

            $currentdude = $_SESSION["useruid"];

makeUserHavePancake($conn, $currentdude);
  
        } else {

            $currentdude = $_SESSION["useruid"];


   updateUserToHavePancake($pdo, $currentdude);
  


        }

if ($foundmatch === true) {



}



} else {

    $currentdude = $_SESSION["useruid"];



  makeUserNotHavePancake($pdo, $currentdude);







//header("location: ../checkboxes.php?error=recordedfalse");
//exit();
}






} else {

header("location: ../checkboxes.php?error=nologin");
exit();

}





















