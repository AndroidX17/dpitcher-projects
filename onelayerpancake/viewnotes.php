<?php
session_start();
if (isset($_SESSION["useruid"])) {



try {

  require_once '../keys/storage.php';


//$sql = 'UPDATE registration SET firstName="bob" WHERE firstName LIKE "%test%"';
// adjusts any X with Y


//$affectedRows = $pdo->exec($sql);

$title = "basic page";
//$output = 'Database connection established.  ' . 'Updated ' . $affectedRows .' rows.';
//$output = '<p>Database connection established.  </p>';

$sql2 = 'SELECT `id`,`wallet`,`note` FROM `new_walletnotes`';

// $sql2 = 'SELECT `concept` FROM `concepts`';



$wallets = $pdo->query($sql2);
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

//echo "<font style='font-size:22px;font-color:black;'>Search wallet notes</font><BR>"


$output = $output.'<p class="heading">Search wallet notes</p>';
$output = $output.'<BR><BR><BR><BR>';



ob_start();
include __DIR__ . '/templates/notessearch.html.php';
$output = $output.ob_get_clean();

$output = $output.'<p class="heading">View wallet notes</p>';


  ob_start();
  include __DIR__ . '/templates/notesresults.html.php';
  $output2 = ob_get_clean();




if (isset($_GET["error"])) {
  
    if ($_GET["error"] == "succeed") {


        $output = $output."<p>succeed</p>";
    } else if ($_GET["error"] == "error7") {

        $output = $output."<p>you searched a nothing</p>";
  //  } else if ($_GET["error"] == "invalidemail") {

  //      echo "<p>Choose a proper email!</p>";
    } else if ($_GET["error"] == "error6") {

        $output = $output."<p>error6</p>";
  } else if ($_GET["error"] == "nomatch") {

    $output = $output."<p>no match found</p>";
} else if ($_GET["error"] == "error5") {

    $output = $output."<p>error5</p>";
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
  }
   include __DIR__ . '/templates/layout.html.php';

  // include __DIR__ . '/templates/formresults.html.php';
   ?>