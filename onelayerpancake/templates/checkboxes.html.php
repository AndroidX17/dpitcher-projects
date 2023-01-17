<h2>CHECKBOX TEST</h2>

<p>Welcome to CHECKBOX TEST </p>


<section class="index-intro">

<?php

session_start();

$checkbox1 = false;
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
$output = '<p>Database connection established.  </p>';
        echo $output;
      $sql = 'SELECT `username`,`has_pancake` FROM `user_has_pancake`';
        
      $result = $pdo->query($sql);

        // $sql2 = 'SELECT `concept` FROM `concepts`';
$currentloggedinuser = $_SESSION["useruid"];
$foundmatch = false;
$discoveredpermissions = false;
foreach ($result as $row) {
    $stuff = $row['username'];
    if ($stuff === $currentloggedinuser) {
$foundmatch = true;
$discoveredpermissions = $row['has_pancake'];
    }

          }

          if (!$foundmatch === false) {
//echo "BLEE BLEE ";

if ($discoveredpermissions) {
 //   echo "U have pancake";
    $permissionstate = true;
 

} else {




   // echo "U have no pancake";

    $permissionstate = false;

  // we need to change the entry to 1 for this user




}



          } else {
          //  echo " BLOO BLOO";
          }
      
      //  $concepts = $pdo->query($sql2);
        //$result = $pdo->query($sql2);
   
     //   $output2 = '';
        
      //  echo "we know of the following";
        
        /*
        while ($row = $result->fetch()) {
            $names[] = $row['firstName'];
          }*/
/*
          foreach ($concepts as $row) {
            $conceptz[] = $row['concept'];
          }
  */
      //    echo '<script type="text/javascript">';
          
      //$newarray = array('abc', 'def', 'ghi');
   //   $js_array = json_encode($conceptz);
   //  echo "var javascript_array = ". $js_array . ";\n";
    //  echo "document.write(javascript_array);"    
    //    echo '</script>';


      //  foreach ($result as $row) {
        

       //   $newarray
          //  $concepts[] = array('id' => $row['id'], 'concept' =>
           // $row['concept']);
        
         //  $concepts[] = $result;
        
        
        //  }


        //$concepts = $result;
        
       //   ob_start();
       //   include 'showconcepts.html.php';
       //   $output2 = ob_get_clean();
        //  $output2 = include '/templates/formresults.html.php';
        /*
          foreach ($names as $name) {
            $output2 .= '<blockquote>';
            $output2 .= '<p>';
            $output2 .= $name;
            $output2 .= '</p>';
            $output2 .= '</blockquote>';
        }
        */
        
          





} else {

echo "please log in";
$error = "need log in";
}



?>




<?php 



if (isset($_GET["error"])) {
  
    if ($_GET["error"] == "nologin") {


        echo "<p>you must log in to use </p>";
    } else if ($_GET["error"] == "changedtofalse") {

       echo "<p>you no longer have pancake on the server!</p>";
  //  } else if ($_GET["error"] == "invalidemail") {

  //      echo "<p>Choose a proper email!</p>";
    } else if ($_GET["error"] == "failuretoconnect2") {

      echo "<p>failed to connect!</p>";
  } else if ($_GET["error"] == "failuretoconnect") {

    echo "<p>failed to connect!</p>";
} else if ($_GET["error"] == "stmtfailed") {

        echo "<p>Something went wrong! Try Again</p>";
    } else if ($_GET["error"] == "changedtotrue") {

      echo "<p>you have pancake on server now!</p>";
  } else if ($_GET["error"] == "bigerror") {

    echo "<p>big error what the deal</p>";
} else if ($_GET["error"] == "none") {

        echo "no error";
    }

}
?>




<div>
<form method="POST" action="includes/checkbox.inc.php" id="checkboxform" name="checkboxform">

<h1>Checkbox Related to Database</h1>
<p>This is Checkbox1. It is stored for you.</p>
<input type="checkbox" name="Check1" id="Check1" onclick="forceSubmit()" <?php if ($permissionstate === true) { echo 'checked'; } ?> >
<br><br>
<input type="submit" name="submit1" id="submit1" value="submit1">
</form>




</div>

<SCRIPT Language="javascript">

function forceSubmit() {
console.log("force submit occurred");
    document.forms['checkboxform'].submit();
}


    </SCRIPT>
<?php

echo $output
?>