<?php
session_start();
try {
require_once '../keys/storage.php';

    if (isset($_SESSION["useruid"])) {
        if ($_SESSION["useruid"] === "admin") {

        //    $sql = 'UPDATE registration SET firstName="bob" WHERE firstName LIKE "%test%"';
            // adjusts any X with Y
            
            $sql2 = 'SELECT * FROM `users_permissions` WHERE `username` = "' .  $_POST['id'] . '"';
            $result1 = $pdo->query($sql2);


            while ($row = $result1->fetch()) {


                $names[] = $row['username'];


              }


if (!$names) {
   

    require_once '../keys/storage.php';
 $sql3 = 'INSERT INTO `users_permissions` (`username`, `is_admin`) VALUES (?, ?)';
 $stmt2 = $conn->prepare($sql3);

 $integ = 1;


$stmt2->bind_param("si",$_POST['id'], $integ);
$stmt2->execute();



$hadrequest = "NO REQUEST";
// $hadpermissions = "NO REQUEST";



$currentuser = $_POST['id'];
       //  $newhaspancake = 1;
     
          $sql4 = 'SELECT `username`,`has_request` FROM `user_has_request` WHERE `username`="' . $currentuser . '";';
     
         
$result4 = $conn->query($sql4);


$one4 = "1";
foreach ($result4 as $row4) {
$stuff4 = $row4['username'];
$stuff24 = $row4['has_request'];
if ($stuff4 === $currentuser) {

if ($stuff24 === $one4) {

    $hadrequest = "HAS REQUEST";
}

}
}


if ($hadrequest === "HAS REQUEST") {

    
   //header('location: admin.php?error=shouldadeletede');
 // exit();
}






   header('location: admin.php?error=scenario3');
   exit();
}




if (empty($result1)) {

    header('location: admin.php?error=scenario1');
    exit();
} else {

//echo " hey".$_POST['id'];


require_once '../keys/storage.php';

$hadpermissions = 0;

//$lookupuser = lookUpUserPermissions($currentusername);        
$currentusername = $_POST['id'];

$sql = 'SELECT `username`,`is_admin` FROM `users_permissions` WHERE `username`="' . $currentusername. '"';

$result = $pdo->query($sql);



$one = "1";
foreach ($result as $row) {
 $stuff = $row['username'];
 $stuff2 = $row['is_admin'];
if ($stuff === $currentusername) {

if ($stuff2 === $one) {

     $hadpermissions = 1;
}

}
}


$newpermissions = 0;

if ($hadpermissions === 1) {
    $newpermissions = 0;
}
if ($hadpermissions === 0) {
    $newpermissions = 1;
}

$sql4 = 'UPDATE `users_permissions` SET `is_admin`=' . $newpermissions . ' WHERE `username` LIKE "' . $_POST['id'] . '"';

$affectedRows = $pdo->exec($sql4);




$hadrequest = "NO REQUEST";
// $hadpermissions = "NO REQUEST";



$currentuser = $_POST['id'];
       //  $newhaspancake = 1;
     
          $sql4 = 'SELECT `id`,`username`,`has_request` FROM `user_has_request` WHERE `username`="' . $currentuser . '";';
     
         $newid;
$result4 = $conn->query($sql4);


$one4 = "1";
foreach ($result4 as $row4) {
$stuff4 = $row4['username'];
$stuff24 = $row4['has_request'];
$stuff34 = $row4['id'];
if ($stuff4 === $currentuser) {

if ($stuff24 === $one4) {
    $newid = $stuff34;
    $hadrequest = "HAS REQUEST";
}

}
}

if ($hadrequest === "HAS REQUEST") {
if ($newpermissions === 1) {


    // delete $newid
    require_once '../keys/storage.php';
$sql5 = 'DELETE FROM `user_has_request` where `id` = :id';
$stmt = $pdo -> prepare($sql5);
$stmt->bindValue(':id', $newid);
$stmt->execute();
    header('location: admin.php?error=none');

    exit();
}
  

}






//$stmt4 = $conn->prepare($sql4);


//$stmt2->bind_param("si",$_POST['id'], $newpermissions);
//$stmt2->execute();

  header('location: admin.php?error=none');

  exit();



}

            
    $sql = 'UPDATE users_permissions  SET is_admin=1 where `user_id` = :id';
$stmt = $pdo -> prepare($sql);
$stmt->bindValue(':id', $_POST['id']);
$stmt->execute();

header('location: admin.php');

        }else {
            echo 'no';
        }
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