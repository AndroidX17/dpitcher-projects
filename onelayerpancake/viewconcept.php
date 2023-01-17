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
$output = '<p>Database connection established.  </p>';

$sql2 = 'SELECT `id`,`concept` FROM `concepts`';

// $sql2 = 'SELECT `concept` FROM `concepts`';



$concepts = $pdo->query($sql2);
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
  include __DIR__ . '/templates/formresultsconcepts.html.php';
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
  }
   include __DIR__ . '/templates/layout.html.php';

  // include __DIR__ . '/templates/formresults.html.php';
   ?>