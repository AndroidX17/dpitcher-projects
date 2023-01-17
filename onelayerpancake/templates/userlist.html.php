<?php 
if (isset($error)): ?>
    <p>
      <?php echo $error; ?>
    </p>

<?php 



if (isset($_SESSION["useruid"])) {

    if ($_SESSION["useruid"] === "admin") {
    
    } else {


        header("location: ../index.php");
exit();
    }


} else {


    header("location: ../index.php");
exit();


}


require_once 'functions.inc.php';



?>


  
    <?php else: ?>
    <?php foreach ($users as $user): ?>
    <blockquote style="display: table; margin-bottom: 1em; border-bottom: 1px solid #ccc; padding: 0.5em;">
      <p style="display: table-cell; width: 90%; vertical-align: top;">



      <?php 
      

      $hadpermissions = " is a normal user";

   //$lookupuser = lookUpUserPermissions($currentusername);        
$currentusername = $user['usersUid'];

$hadrequest = "NO REQUEST";
// $hadpermissions = "NO REQUEST";




       //  $newhaspancake = 1;
     
          $sql3 = 'SELECT `username`,`has_request` FROM `user_has_request` WHERE `username`="' . $currentusername . '";';
     
         
$result3 = $conn2->query($sql3);


$one3 = "1";
foreach ($result3 as $row3) {
$stuff3 = $row3['username'];
$stuff23 = $row3['has_request'];
if ($stuff3 === $currentusername) {

if ($stuff23 === $one3) {

    $hadrequest = "HAS REQUEST";
}

}
}





   $sql = 'SELECT `username`,`is_admin` FROM `users_permissions` WHERE `username`="' . $currentusername. '"';

   $result = $pdo->query($sql);


   $one = "1";
   foreach ($result as $row) {
    $stuff = $row['username'];
    $stuff2 = $row['is_admin'];
  if ($stuff === $currentusername) {
 
 if ($stuff2 === $one) {

        $hadpermissions = "is privileged user";
    //    $hadrequest = "";
 }

  }
 //  $hadpermissions = $row['is_admin'];
     }
    

     echo htmlspecialchars($currentusername, ENT_QUOTES, 'UTF-8');
     echo " ";
     echo htmlspecialchars($hadpermissions, ENT_QUOTES, 'UTF-8');
     echo " ";
     echo htmlspecialchars($hadrequest, ENT_QUOTES, 'UTF-8');
      
    
      
      
      ?>





<form style="display: table-cell; width: 10%;" action="adjustuser.php" method="post">
    <input type="hidden" name="id" value="<?php echo $currentusername ?>">
    <input type="submit" class="bugga3" value="Toggle Permissions">
  </form>

<form style="display: table-cell; width: 3%;" action="/includes/deleteuser.inc.php" method="post">
    <input type="hidden" name="deleteid" value="<?php if ($currentusername === "admin") {} else { echo $currentusername; } ?>">
    <input type="submit" class="bugga4" value="Delete" onclick="return confirm('Do you want to submit? Yes/No')">
    
  </form>
      </p>
    </blockquote>
    <?php endforeach; ?>
    <?php endif; ?>








    <?php 

//<input type="text" name="name" placeholder="full name...."><BR>
//<input type="text" name="email" placeholder="email...."><BR>


if (isset($_GET["error"])) {

    if ($_GET["error"] == "scenario1") {


        echo "<p>scenario 1 happen</p>";
    } else if ($_GET["error"] == "scenario2") {

       echo "<p>scenario 2 happen</p>";
  //  } else if ($_GET["error"] == "invalidemail") {

  //      echo "<p>Choose a proper email!</p>";
    } else if ($_GET["error"] == "scenario3") {

        echo "<p>passwords dont match!</p>";
    } else if ($_GET["error"] == "stmtfailed") {

        echo "<p>Something went wrong! Try Again</p>";
    } else if ($_GET["error"] == "k4") {

        echo "<p>you have triggered k4!</p>";
    } else if ($_GET["error"] == "none") {

        echo "<p>there was a toggle</p>";
    }

}
?>


<form style="display: table-cell; width: 10%;" action="sqlconnect/additem.php" method="post">
    <input type="text" name="item_name" placeholder="item_name" value="wood">
    <input type="submit" class="bugga3" value="add item">
  </form>
<BR><BR>







<form style="display: table-cell; width: 10%;" action="includes/serversettings.inc.php" method="post">
    <input type="text" name="serverIP" placeholder="IP" value="<?php echo $_SERVER['REMOTE_ADDR'] ?>">
    <input type="text" name="serverPORT" placeholder="PORT" value="7770">
    <input type="text" name="serverACTIVE" placeholder="active" value="0">
    <input type="submit" class="bugga3" value="Change Server Settings">
  </form>


    
    <?php echo $output2; ?>