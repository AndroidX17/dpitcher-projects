<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
 
    <title>  <?php echo $title; ?></title>
    
  <link rel="stylesheet" href="styles.css">
  </head>
  <body>

  <header>
    <h1>OneLayerPancake Database Test</h1>
  </header>

  <nav>
    <ul>
      <li><a href="https://www.onelayerpancake.com">home</a></li>
      <?php

session_start();



?>

<?php
    if (isset($_SESSION["useruid"])) {

     // echo '<li><a href="database.php">Database test</a></li>';
    //  echo ' <li><a href="default.html">Access test signup form</a></li>';
   echo ' <li><a href="addconcept.php">add todo</a></li>';
    echo ' <li><a href="viewconcept.php">view todos</a></li>';
     // echo ' <li><a href="autophilosopher.php">Autophilosopher</a></li>';
    //  echo ' <li><a href="checkboxes.php">Checkbox test</a></li>';
      echo ' <li><a href="crypto2.php">crypto tx assess</a></li>';
      echo ' <li><a href="bitcoin2.php">crypto wallet assess</a></li>';
      echo ' <li><a href="walletnotes.php">wallet notes</a></li>';
      echo ' <li><a href="viewnotes.php">view notes</a></li>';
      echo ' <li><a href="clustermanager.php">cluster manager</a></li>';
     // echo ' <li><a href="buddy.php">buddy reports</a></li>';

      echo ' <li><a href="publickeyfinder.php">public key finder</a></li>';

      if ($_SESSION["permissions"] === "NORMAL") {





$sql = 'SELECT `username`,`is_admin` FROM `users_permissions` WHERE `username`="' . $_SESSION["useruid"]. '";';

require_once '../keys/storage.php';



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

if ($hadpermissions === "1" || $hadpermissions === 1) {
  echo ' <li><a href="requestpermissions.php">your permission request was granted, please relog</a></li>';
  

} else {

      echo ' <li><a href="requestpermissions.php">request permissions</a></li>';
}
      }

     // echo "<li><a href='profile.php'>Profile</a></li>";


    if ($_SESSION["useruid"] === "admin") {



      $sql = "SELECT * FROM `user_has_request`";

      require_once '../keys/storage.php';

      $query = mysqli_query($conn2, $sql);

      $rowcount=mysqli_num_rows($query);
    

//$result = $conn->query($sql);

//$rows = mysql_result(mysql_query('SELECT COUNT(*) FROM table'), 0);

//if (!$rows) { /* Table is empty */ }

/*
if (mysql_num_rows($result) > 0) { 
  echo "Table is not Empty";
 } else {
  echo "empty";
 }
*/

if ($rowcount === 0) {

      echo "<li><a href='admin.php'>Admin</a></li>";
    } else {
      echo "<li><a href='admin.php'>Admin (" .   $rowcount . " pending requests) </a></li>";

    }
      
    }

    echo "<li><a href='includes/logout.inc.php'>log out</a></li>";







    if ($_SESSION["permissions"] === "SPECIAL") {

   //   echo "<li><a href='special.php'>Special</a></li>";
      echo "<p class='permissions'>you have permissions</p>";
    } else {
      
   //   echo "<li><a href='special.php'>Special</a></li>";
   echo "<p class='permissions'>you can request permissions</p>";
    }
} else {

  echo "<lI><a href='signup.php'>sign up</A></li>";
  echo "<lI><a href='login.php'>log in</A></li>";

}


?>


  </ul>
  </nav>

  <main>
  <?php echo $output; ?>
  <BR> 
 
    <BR>

    <?php if (isset($error)): ?>
  <p>
    <?php echo $error; ?>
  </p>

  
  <?php else: ?>
  <?php foreach ($names as $name): ?>
  <blockquote>
    <p>
    <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>
    </p>
  </blockquote>
  <?php endforeach; ?>
  <?php endif; ?>

  <?=$output2?>
  </main>

  <footer>
  &copy; OneLayerPancake 2022

  <BR><A HREF="https://www.onelayerpancake.com"><IMG SRC="../OLP2.png" style="float:left;width:208px;height:102px"></A>
  </footer>
  </body>
</html>