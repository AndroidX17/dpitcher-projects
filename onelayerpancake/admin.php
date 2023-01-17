<?php
session_start();
if (isset($_SESSION["useruid"])) {

    if ($_SESSION["useruid"] === "admin") {


try {

  
  require_once '../keys/storage.php';
//$sql = 'UPDATE registration SET firstName="bob" WHERE firstName LIKE "%test%"';
// adjusts any X with Y


//$affectedRows = $pdo->exec($sql);

$title = "basic page";
//$output = 'Database connection established.  ' . 'Updated ' . $affectedRows .' rows.';
$output = '<p>Database connection established.  </p>';

$sql2 = 'SELECT `usersId`,`usersUid` FROM `users`';

// $sql2 = 'SELECT `concept` FROM `concepts`';



$users = $pdo->query($sql2);
//$result = $pdo->query($sql2);

$output2 = '';


/*
while ($row = $result->fetch()) {
    $names[] = $row['firstName'];
  }*/
/*
  foreach ($result as $row) {
    $concepts[] = $row['concept'];
  }
*/
/*
foreach ($result as $row) {

  //  $concepts[] = array('id' => $row['id'], 'concept' =>
   // $row['concept']);

 //  $concepts[] = $result;


  }
*/
//$concepts = $result;

  ob_start();
  include __DIR__ . '/templates/userlist.html.php';
  $output2 = ob_get_clean();




  
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
  
  if ($_GET["error"] == "successdelete") {


      $output = $output."<p>successfully deleted</p>";
  } else if ($_GET["error"] == "error7") {

      $output = $output."<p>you searched a nothing</p>";
//  } else if ($_GET["error"] == "invalidemail") {

//      echo "<p>Choose a proper email!</p>";
  } else if ($_GET["error"] == "error6") {

      $output = $output."<p>error6</p>";
}else if ($_GET["error"] == "executed") {

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