<?php

session_start();



if (isset($_SESSION["useruid"])) {
    $check1 = $_POST["usernames"];

   // require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

if ($check1 === "") {




    header("location: ../requestpermissions.php?error=nodata");
    exit();


} else {




    $currentdude = $_SESSION["useruid"];



    try {
    
      
        require_once '../../keys/storage.php';
        $sql = 'SELECT `username`,`has_request` FROM `user_has_request`';
            $needsrequest = false;
        $result = $pdo->query($sql);
    $hadpermissions = false;

// working with no bugs up to this line

          // $sql2 = 'SELECT `concept` FROM `concepts`';
    $currentloggedinuser = $_SESSION["useruid"];
    $foundmatch = false;
    foreach ($result as $row) {
      $stuff = $row['username'];
      if ($stuff === $currentloggedinuser) {
    $foundmatch = true;
    $hadpermissions = $row['has_request'];
      }
    
            }
    

            


            if ($foundmatch === false) {
    
            //    $currentdude = $_SESSION["useruid"];
            $needsrequest = true;
    
            } else {
    
             //   $currentdude = $_SESSION["useruid"];
    
           
             if ($hadpermissions) {
    
                $needsrequest = false;
             } else {
    
                $needsrequest = true;
             }
    
    
    
            }
    
    if ($needsrequest) {


        makePermissionRequest($conn, $currentloggedinuser);
        

    } else {

        header("location: ../requestpermissions.php?error=youdontneedtorequest");


        exit();
    }
    
    } 
    catch (PDOException $e) {
     $output = 'Unable to connect to the database server.' . 'Database error: ' . $e->getMessage() . ' in ' .
     $e->getFile() . ':' . $e->getLine();
     header("location: ../requestpermissions.php?error=bigerror");
    exit();
    
    }


}






} else {

header("location: ../requestpermissions.php?error=nologin");
exit();

}





















