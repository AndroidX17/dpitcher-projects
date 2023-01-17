<?php
session_start();
if (isset($_SESSION["useruid"])) {

    if ($_SESSION["permissions"] === "SPECIAL") {


try {

  
 require_once '../keys/storage.php';


$title = "helper portal";

$output = '<p>Database connection established.  </p>';




$sql2 = 'SELECT * FROM `builds` ORDER BY id DESC';



//id name link notes tested




$builds = $pdo->query($sql2);



ob_start();
include __DIR__ . '/playtest-templates/playtest.html.php';
$output = $output.ob_get_clean();

$output2 = '';


  ob_start();
  include __DIR__ . '/playtest-templates/userbuildlist.html.php';
  $output2 = ob_get_clean();


   } 
   catch (PDOException $e) {
    $output = 'Unable to connect to the database server.' . 'Database error: ' . $e->getMessage() . ' in ' .
    $e->getFile() . ':' . $e->getLine();
   }
  } else {
echo 'insufficient privilege';
  }
}



if (isset($_GET["error"])) {
  
  if ($_GET["error"] == "success") {


      $output = $output."<p>successfully submitted</p>";
  } else if ($_GET["error"] == "error7") {

      $output = $output."<p>you searched a nothing</p>";
//  } else if ($_GET["error"] == "invalidemail") {

//      echo "<p>Choose a proper email!</p>";
  } else if ($_GET["error"] == "none") {

      $output = $output."<p>error6</p>";
}else if ($_GET["error"] == "thank you") {

  $output = $output."<p>the fix was executed</p>";
} else if ($_GET["error"] == "nomerge") {

  $output = $output."<p>there is not a merge opportunity</p>";
} else if ($_GET["error"] == "merge") {

  $output = $output."<p>there is a merge opportunity</p>";
} else if ($_GET["error"] == "nomatch") {

  $output = $output."<p>no match found</p>";
} else if ($_GET["error"] == "validation") {

  $output = $output."<p style='color:#a1ffba'>Successfully validated data</p>";
} else if ($_GET["error"] == "error4") {

  $output = $output."<p>error4 </p>";
  } else if ($_GET["error"] == "error3") {

      $output = $output."<p>error3</p>";
} else if ($_GET["error"] == "empty") {

  $output = $output."<p>empty</p>";
} else if ($_GET["error"] == "alldone") {

  $output = $output."<p>all done</p>";
  }

}



   include __DIR__ . '/templates/layout.html.php';

  // include __DIR__ . '/templates/formresults.html.php';
   ?>