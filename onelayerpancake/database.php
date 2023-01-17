<?php

session_start();


if (isset($_SESSION["useruid"])) {

try {
  require_once '../keys/storage.php';
$sql = 'UPDATE registration SET firstName="bob" WHERE firstName LIKE "%test%"';
// adjusts any X with Y


$affectedRows = $pdo->exec($sql);


$output = 'Database connection established.  ' . 'Updated ' . $affectedRows .' rows.' . '<BR> Anyone who was named test is now named bob.  Here are the current users on the system:';

$sql2 = 'SELECT `firstName` FROM `registration`';
$result = $pdo->query($sql2);

/*
while ($row = $result->fetch()) {
    $names[] = $row['firstName'];
  }*/

  foreach ($result as $row) {
    $names[] = $row['firstName'];
  }


   } 
   catch (PDOException $e) {
    $output = 'Unable to connect to the database server.' . 'Database error: ' . $e->getMessage() . ' in ' .
    $e->getFile() . ':' . $e->getLine();
   }
  } else {
    echo 'please log in';
  }
  // include  __DIR__ . '/templates/output.html.php';
   include  __DIR__ . '/templates/layout.html.php';
   ?>