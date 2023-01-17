<?php

try {
  require_once '../keys/storage.php';

//$sql = 'UPDATE registration SET firstName="bob" WHERE firstName LIKE "%test%"';
// adjusts any X with Y


//$affectedRows = $pdo->exec($sql);

$title = "basic page";
//$output = 'Database connection established.  ' . 'Updated ' . $affectedRows .' rows.';
$output = 'Database connection established.  ';

$sql2 = 'SELECT `firstName` FROM `registration`';
$result = $pdo->query($sql2);

$output2 = '';


/*
while ($row = $result->fetch()) {
    $names[] = $row['firstName'];
  }*/

  foreach ($result as $row) {
    $names[] = $row['firstName'];
  }

  ob_start();
  include __DIR__ . '/templates/formresults.html.php';
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

   include __DIR__ . '/templates/layout.html.php';

  // include __DIR__ . '/templates/formresults.html.php';
   ?>