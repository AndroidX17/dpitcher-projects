<?php

session_start();

$output = "";

if (isset($_POST['concepttext'])) {
    try {
      require_once '../keys/storage.php';
//echo $concepttext;
//console.log("test");
     // $stmt = $conn->prepare("INSERT INTO concepts (concept) VALUES (?)");
     $concepttext = $_POST['concepttext'];
    
    // $stmt->bind_param("s",$concepttext);
     // $stmt->execute(); 


        $sql = 'INSERT INTO `concepts` SET `concept` = :concepttext';
    // $sql = 'INSERT INTO concepts (concept) VALUES (?)';

  $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':concepttext', $concepttext);
    $stmt->execute();

   // $stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, language, email, password)
   // VALUES (?, ?, ?, ?, ?)");
 $output2 = "<p>Thank you</p>";

 //   $stmt->bind_param("s",$_POST['concepttext']);
//    $stmt->execute();
/*$sql = 'INSERT INTO `joke` SET
  `joketext` = :joketext,
  `jokedate` = CURDATE()';
  */

    } catch (PDOException $e) {
        $title = 'An error has occurred';

        $output = $output.'Database error: ' . $e->getMessage() . ' in ' .
    $e->getFile() . ':' . $e->getLine();
    }
} else {
    $title = 'Add a new concept';

 

    if (isset($_SESSION["useruid"])) {

      if ($_SESSION["permissions"] === "SPECIAL") {

    ob_start();

 
    include  __DIR__ . '/templates/addconcept.html.php';
    $output = $output.ob_get_clean();
    ob_end_clean();
      } else {

        $output = "you dont have permission to add";
      }





    } else {
      $output = $output."not logged in";
    }
}
include  __DIR__ . '/templates/layout.html.php';

?>