<?php 


function emptyInputSignup($username, $pwd, $pwdRepeat) {
    //function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
$result;

//if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
    if (empty($username) || empty($pwd) || empty($pwdRepeat)) {
$result = true;

} else {
    $result = false;
}
return $result;


}
function invalidUid($username) {

    $result;
    
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
    
    } else {
        $result = false;
    }
    return $result;


    }
    






    function invalidEmail($email) {
        $result;
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
        
        } else {
            $result = false;
        }
        return $result;
        }
 


        function pwdMatch($pwd, $pwdRepeat) {
            $result;
            
            if ($pwd !== $pwdRepeat) {
            $result = true;
            
            } else {
                $result = false;
            }
            return $result;
            }
 
    

            function uidExists($conn, $username, $email) {
                
                $sql = 'SELECT * FROM users WHERE usersUid = ? OR usersUid = ?;';
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
header("location: ../signup.php?error=stmtfailedzz");
exit();

}

mysqli_stmt_bind_param($stmt, "ss", $username, $email);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($resultData)) {
return $row;


} else {
    $result = false;
    return $result;
}

mysqli_stmt_close($stmt);


                }
     
                function addUserPermissions($conn, $userid, $isadmin, $createdat, $updatedat) {

                    $sql2 = 'INSERT INTO users_permissions (user_id, is_admin, created_at, updated_at) VALUES (?,?,?,?);';

                    $stmt = mysqli_stmt_init($conn);
    

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("location: ../signup.php?error=stmtfailed");
                        exit();
                        
                        }



                }
    

            function createUser($conn, $username, $pwd) {


   $sql = 'INSERT INTO users (usersUid, usersPwd) VALUES (?,?)';
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed2");
    exit();
    
    }
    
$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPwd);


    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);




    header("location: ../signup.php?error=none");
    exit();
                    }

function emptyInputLogin($username, $pwd) {
    $result;

    if (empty($username) || empty($pwd)) {
    $result = true;
    
    } else {
        $result = false;
    }
    return $result;
    

}

function loginUser($conn, $username, $pwd, $pdo) {

$uidExists = uidExists($conn, $username, $username);

if ($uidExists === false) {

header("location: ../login.php?error=wronglogin");
exit();

}



//$pwdHashed = $uidExists["usersPwd"];
$pwdHashed = $uidExists["usersPwd"];

$checkPwd = password_verify($pwd, $pwdHashed);


if ($checkPwd === false) {

    
header("location: ../login.php?error=wronglogin");
exit();

} else if ($checkPwd === true) {

    session_start();

    $_SESSION["userid"] = $uidExists["usersId"];
    $_SESSION["useruid"] = $uidExists["usersUid"];
     


   

$hadpermissions = "NORMAL";

//$lookupuser = lookUpUserPermissions($currentusername);        
$currentusername = $uidExists["usersUid"];

$sql = 'SELECT `username`,`is_admin` FROM `users_permissions` WHERE `username`="' . $currentusername. '"';

$result = $pdo->query($sql);



$one = "1";
foreach ($result as $row) {
 $stuff = $row['username'];
 $stuff2 = $row['is_admin'];
if ($stuff === $currentusername) {

if ($stuff2 === $one) {

     $hadpermissions = "SPECIAL";
}

}
}

$_SESSION["permissions"] = $hadpermissions;

    header("location: ../index.php");
    exit();



}

}

function makeUserHavePancake($conn, $username) {

if ($conn === false) {

    header("location: ../checkboxes.php?error=failuretoconnect");
    exit();


}
$newhaspancake = 1;

//$boolea = "true";

 $sql = 'INSERT INTO user_has_pancake (username, has_pancake) VALUES (?,?);';
   $stmt = mysqli_stmt_init($conn);
    
  if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("location: ../checkboxes.php?error=stmtfailedz");
 exit();
    
   }
 
    mysqli_stmt_bind_param($stmt, "si", $username, $newhaspancake);

//echo $username;
    mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);



header("location: ../checkboxes.php?error=none");
  exit();
          






}


function makeUserNotHavePancake($pdo, $username) {

   
  
    //$boolea = "true";
    
   //  $sql = 'INSERT INTO user_has_pancake (username, has_pancake) VALUES (?,?);';

     $sql = 'UPDATE user_has_pancake SET has_pancake=0 WHERE username LIKE "' . $username . '"';
// adjusts any X with Y


$affectedRows = $pdo->exec($sql);



   
    
    header("location: ../checkboxes.php?error=changedtofalse");
      exit();
              
  
    
    
    
    
    
    }
    
    
    
function updateUserToHavePancake($pdo, $username) {

   

     $sql = 'UPDATE user_has_pancake SET has_pancake=1 WHERE username LIKE "' . $username . '"';
// adjusts any X with Y


$affectedRows = $pdo->exec($sql);



   
    
    header("location: ../checkboxes.php?error=changedtotrue");
      exit();
              
  
    
    
    
    
    
    }
    
    
    


   



function makePermissionRequest($conn, $currentloggedinuser) {





  //  $newhaspancake = 1;

     $sql = 'INSERT INTO user_has_request (username, has_request) VALUES (?,?);';

    // $sql = 'INSERT INTO user_has_request (username, has_request) VALUES (?,?);';
    //   $stmt = mysqli_stmt_init($conn);
        
    //  if (!mysqli_stmt_prepare($stmt, $sql)) {
    //  header("location: ../requestpermissions.php?error=stmtfailed");
    // exit();
        
     //  }

$one = 1;
        $stmt = $conn -> prepare($sql);


      //  echo $currentloggedinuser;
       // echo "<BR>";
      //  echo $one;


 $stmt->bind_param("si", $currentloggedinuser, $one);
    

     //  $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
       
    header("location: ../requestpermissions.php?error=none");



    exit();


    /*
        mysqli_stmt_bind_param($stmt, "si", $username, $newhaspancake);

        mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    
    

 
*/


}




