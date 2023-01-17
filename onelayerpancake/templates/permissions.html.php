<h2>permission ask</h2>

<p>you can click and ask for a permission </p>


<section class="index-intro">

<?php

session_start();


$permissionstate = false;
?>

<?php
    if (isset($_SESSION["useruid"])) {
    echo "<p>logged in as " . $_SESSION["useruid"]. "</p>";


  //  echo " RANDOM STATEMENT";




        //$sql = 'UPDATE registration SET firstName="bob" WHERE firstName LIKE "%test%"';
        // adjusts any X with Y
        
        
        //$affectedRows = $pdo->exec($sql);
        
       
        //$output = 'Database connection established.  ' . 'Updated ' . $affectedRows .' rows.';
//$output = '<p>Database connection established.  </p>';
        echo $output;
      $sql = 'SELECT `username`,`is_admin` FROM `users_permissions`';
        
      $result = $pdo->query($sql);

        // $sql2 = 'SELECT `concept` FROM `concepts`';
$currentloggedinuser = $_SESSION["useruid"];
$foundmatch = false;
$discoveredpermissions = false;
foreach ($result as $row) {
    $stuff = $row['username'];
    if ($stuff === $currentloggedinuser) {
$foundmatch = true;
$discoveredpermissions = $row['is_admin'];
    }

          }

         // echo " wer here";
          if (!$foundmatch === false) {
//echo "BLEE BLEE ";

if ($discoveredpermissions) {
 //   echo "U have pancake";
    $permissionstate = true;
 
//echo "you do  have permission";

} else {




   // echo "U have no pancake";

    $permissionstate = false;

  // we need to change the entry to 1 for this user

//echo "you do not have permission";


}



          } else {
            $permissionstate = false;

          //  echo " BLOO BLOO";
          }
      
    
          


           if ($permissionstate === false) {

         //   echo "you have no permits so go ask";
        }
        if ($permissionstate === true) {

           echo "you already have a permision do not need to ask";        
            
        }


} else {

echo "please log in";
$error = "need log in";
}



?>




<?php 



if (isset($_GET["error"])) {
  
    if ($_GET["error"] == "nologin") {


        echo "<p>you must log in to use </p>";
    } else if ($_GET["error"] == "nodata") {

       echo "<p>you encountered some kind of no data error</p>";
  //  } else if ($_GET["error"] == "invalidemail") {

  //      echo "<p>Choose a proper email!</p>";
    } else if ($_GET["error"] == "youdontneedtorequest") {

        echo "<p>you have already made a request!</p>";
    }  else if ($_GET["error"] == "bigerror") {

        echo "<p>failed to connect!</p>";
    }else if ($_GET["error"] == "failuretoconnect") {

        echo "<p>failed to connect!</p>";
    } else if ($_GET["error"] == "stmtfailed") {

        echo "<p>bad query!</p>";
    }  else if ($_GET["error"] == "none") {

        echo "<p>you have successfully submitted a request, the admin will get around to approving </p> ";
    }

}
?>


<?php 


 if (isset($_SESSION["useruid"])) {

    if ($_SESSION["permissions"] === "NORMAL") {





$sql = 'SELECT `username`,`is_admin` FROM `users_permissions` WHERE `username`="' . $_SESSION["useruid"]. '";';





$result = $pdo->query($sql);
$hadpermissions = 0;
// $sql2 = 'SELECT `concept` FROM `concepts`';
$currentloggedinuser = $_SESSION["useruid"];
$foundmatch = false;
foreach ($result as $row) {
$stuff = $row['username'];
if ($stuff === $currentloggedinuser) {
$foundmatch = true;
$hadpermissions = $row['is_admin'];
}
}

if ($hadpermissions === "1") {
echo '<h5> Your permission request was granted, please relog</h5>';

} 
    }
}


?>


<div>
<form method="POST" action="includes/permissions.inc.php" id="permissionsform" name="permissionsform">
<?php

if ($hadpermissions === "0") {
    echo '<h1>you can ask for pemrission</h1>';
    echo ' <p>it can be granted when admin sees your request</p>';
    } 

?>


<input type="text" name="usernames" id="usernames" readonly value="<?php echo $_SESSION["useruid"]; ?>" >


<?php

if ($hadpermissions !== "1") {
    echo '<input type="submit" name="submit" id="submit" value="submit"><BR>';
    
    } 

?>


</form>




</div>


<?php

echo $output
?>