<?php
session_start();



try {

  require_once '../keys/storage.php';


//$sql = 'UPDATE registration SET firstName="bob" WHERE firstName LIKE "%test%"';
// adjusts any X with Y


//$affectedRows = $pdo->exec($sql);

$title = "guild event";
//$output = 'Database connection established.  ' . 'Updated ' . $affectedRows .' rows.';
//$output = '<p>Database connection established.  </p>';

if (!isset($_GET["eventname"])) {

$output = "<p>no event</p>";
}  else {
    
    echo "TEST";
$eventname = $_GET["eventname"];


$sql2 = 'SELECT * FROM `events` WHERE `eventname` = "'.$eventname.'";';

// $sql2 = 'SELECT `concept` FROM `concepts`';



$guildevents = $pdo->query($sql2);
//$result = $pdo->query($sql2);
$maxplayers = -1;
$eventdate = "";
$player1 = "";
$player2 = "";
$player3 = "";
$player4 = "";
$player5 = "";

$totalentries = 0;

/*
foreach ($result as $resulto) {

    $maxplayers = $resulto["maxplayers"];
    $eventdate = $resulto["date"];
    $player1 = $resulto["player1"];
    $player2 = $resulto["player2"];
    $player3 = $resulto["player3"];
    $player4 = $resulto["player4"];
    $player5 = $resulto["player5"];
  $totalentries = $totalentries + 1;


}


*/


ob_start();
include __DIR__ . '/templates/guildevents.html.php';
$output2 = $output2.ob_get_clean();




$output = $output.'<p class="heading">Guild event</p>';
$output = $output.'<BR><BR><BR><BR>';

/*
$output = $output."MAXPLAYERS:".$maxplayers;
$output = $output."date:".$eventdate;
$output = $output."player1:".$player1;
$output = $output."player2:".$player2;
$output = $output."player3:".$player3;
$output = $output."player4:".$player4;
$output = $output."player5:".$player5;



$output = $output.'<p class="heading">View wallet notes</p>';
*/





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
  
   include __DIR__ . '/templates/layout.html.php';

  // include __DIR__ . '/templates/formresults.html.php';
   ?>