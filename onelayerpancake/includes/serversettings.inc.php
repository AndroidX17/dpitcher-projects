<?php

session_start();

if (isset($_SESSION["useruid"])) {
if ($_SESSION["useruid"] === "admin") {
    if ($_SESSION["permissions"] === "SPECIAL") {
      
            if (isset($_POST["serverIP"])) {
                $serverIP = $_POST["serverIP"];
                $serverPORT = $_POST["serverPORT"];
                $serverACTIVE = intval($_POST["serverACTIVE"]);


                $unity = true;

                require_once '../../keys/storage.php';








                $sql = 'SELECT * FROM `server_settings`';
               $result = $pdo -> query($sql);

              
                while ($row = $result->fetch()) {


                    $names[] = $row['serverip'];
    
    
                  }

                
       
if (!$names) {
   

    $stmt5 = $conn->prepare("INSERT INTO `server_settings` (`serverip`,`serverport`,`active`) VALUES (?,?,?)");
 
 $stmt5->bind_param("ssi",$serverIP, $serverPORT, $serverACTIVE);
 $stmt5->execute(); 

} else {

    $sql = 'UPDATE `server_settings` SET `serverip` = :serverip, `serverport` = :serverport, `active` = :active';//1670475715


    //$sql = 'UPDATE registration SET firstName="bob" WHERE firstName LIKE "%test%"';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':serverip', $serverIP);
      $stmt->bindValue(':serverport', $serverPORT);
      $stmt->bindValue(':active', $serverACTIVE);
      $stmt->execute();

}

      //  $sql = 'DELETE FROM `users` where `usersUid` = :usersUid';
      //  $stmt = $pdo -> prepare($sql);
      //  $stmt->bindValue(':usersUid', $deleteID);
      //  $stmt->execute();
        

      //  $sql = 'DELETE FROM `users_permissions` where `username` = :username';
      //  $stmt = $pdo -> prepare($sql);
      //  $stmt->bindValue(':username', $deleteID);
       // $stmt->execute();
        



    header("location: ../admin.php?error=successchange");
    exit();



            } else {
                header("location: ../admin.php?error=noid");
    exit();

            }
        }else {
            header("location: ../admin.php?error=notspecial");
exit();

        }
    }else {
        header("location: ../admin.php?error=notadmin");
exit();

    }
}else {
    header("location: ../admin.php?error=nouser");
exit();

}


    header("location: ../admin.php?error=oddcase");
exit();












