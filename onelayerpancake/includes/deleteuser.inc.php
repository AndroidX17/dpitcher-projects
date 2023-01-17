<?php

session_start();

if (isset($_SESSION["useruid"])) {
if ($_SESSION["useruid"] === "admin") {
    if ($_SESSION["permissions"] === "SPECIAL") {
      
            if (isset($_POST["deleteid"])) {
    $deleteID = $_POST["deleteid"];





      
        require_once '../../keys/storage.php';

        $sql = 'DELETE FROM `users` where `usersUid` = :usersUid';
        $stmt = $pdo -> prepare($sql);
        $stmt->bindValue(':usersUid', $deleteID);
        $stmt->execute();
        

        $sql = 'DELETE FROM `users_permissions` where `username` = :username';
        $stmt = $pdo -> prepare($sql);
        $stmt->bindValue(':username', $deleteID);
        $stmt->execute();
        
    header("location: ../admin.php?error=successdelete");
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












