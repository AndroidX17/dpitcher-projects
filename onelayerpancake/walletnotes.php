<?php
session_start();




 


$workedout = false;

$newwallet = "";
$newnotes = "";


if (isset($_SESSION["useruid"])) {

  if ($_SESSION["permissions"] === "SPECIAL") {







$foundquery = false;
    






ob_start();
include  __DIR__ . '/templates/walletnotes.html.php';
 


$output = ob_get_clean();
ob_end_clean();
  } else {

    $output = "you dont have permission to add";
  }





} else {
  $output = "not logged in";
}

   include __DIR__ . '/templates/layout.html.php';


   ?>


<?php 



if (isset($_GET["error"])) {
  
    if ($_GET["error"] == "emptyinput") {


        echo "<p>emptyinput</p>";
    } else if ($_GET["error"] == "succeed") {

       echo "<p>successfully added note!</p>";
  //  } else if ($_GET["error"] == "invalidemail") {

  //      echo "<p>Choose a proper email!</p>";
    } else if ($_GET["error"] == "updatedit1") {

      echo "<p>successfully updated note!</p>";
  } else if ($_GET["error"] == "updatedit2") {

    echo "<p>entry was already that way!</p>";
} else if ($_GET["error"] == "stmtfailed") {

        echo "<p>Something went wrong! Try Again</p>";
    } else if ($_GET["error"] == "changedtotrue") {

      echo "<p>you have pancake on server now!</p>";
  } else if ($_GET["error"] == "bigerror") {

    echo "<p>big error what the deal</p>";
} else if ($_GET["error"] == "notwallet") {

    echo "<p>thats no wallet</p>";
} else if ($_GET["error"] == "nonote") {

    echo "<p>no note</p>";
} else if ($_GET["error"] == "none") {

        echo "no error";
    }

}
?>



