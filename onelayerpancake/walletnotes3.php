<?php
session_start();




ob_start();

 


$workedout = false;

$newwallet = "";
$newnotes = "";


if (isset($_SESSION["useruid"])) {

  if ($_SESSION["permissions"] === "SPECIAL") {



    include  __DIR__ . '/templates/walletnotes.html.php';
 




$foundquery = false;
    if (isset($_POST["wallet"])) {


        if ($_POST["wallet"]) {
$newwallet = $_POST["wallet"];

    if (isset($_POST["walletnotes"])) {


        if ($_POST["walletnotes"]) {


            $newnotes = $_POST["walletnotes"];

            $foundquery= true;

            
require_once '../keys/storage.php';


$sql5 = 'SELECT `id`,`wallet`,`notes`,`timestamp` FROM `walletnotes` WHERE `wallet` LIKE "%'.$newwallet.'%"';

// $sql2 = 'SELECT `concept` FROM `concepts`';

$whichmatched = 0;

$result = $pdo->query($sql5);

/*
$resultlength = sizeof($result);
echo "<p>".$resultlength." entries found.</p>";
*/
/*
if ($resultlength === 0) {

    echo "<p>no entries found.</p>";
} else {

    echo "<p>".$resultlength." found.</p>";
}

//$result = $pdo->query($sql2);

$totalrows = $totalrows;



*/
$lasttimestamp = "";


$lasttimestamp = "";
$counter = 0;
foreach ($result as $row) {
    $counter = $counter + 1;
    $lasttimestamp = $row['timestamp'];
    $whichmatched = $row['id'];
  }

echo "<P>".$counter."</P>";

 //$currenttime = date();

/*
 $stmt = $conn->prepare("INSERT INTO `walletnotes` (wallet, notes, timestamp)
 VALUES (?, ?, ?)");
*/

 //$stmt->bind_param("sss",$newwallet, $newnotes, $currenttime);
 //$stmt->execute();


if ($counter === 0) {


    echo "<P>new</P>";


    if ($conn === null) {

        echo "<P>aaa</P>";

    }

    $sql = 'INSERT INTO new_walletnotes (wallet, note) VALUES (?,?)';
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: walletnotes.php?error=fail");
    exit();
    
    }
    echo "<P>new".$newwallet."</P>";
    echo "<P>new".$newnotes."</P>";
    echo "<P>new</P>";

    mysqli_stmt_bind_param($stmt, "ss", "test", "test");

    echo "<P>win</P>";
    /*
    mysqli_stmt_bind_param($stmt, "sss", $newwallet, $newnotes, "test");


    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

*/

  //  $stmt = $conn->prepare("INSERT INTO wallet_notes (wallet, notes, laststamp) VALUES (?, ?, ?)");
 //  $stmt->bind_param("sss",$newwallet, $newnotes, "test");
   // $stmt->execute();

/*
    $currenttime = date();


    $stmt = $conn->prepare("INSERT INTO `walletnotes` (wallet, notes, timestamp)
    VALUES (?, ?, ?)");


    $stmt->bind_param("sss",$_POST["wallet"], $_POST["walletnotes"], $currenttime);
    $stmt->execute();

    
*/


} else {
/*

    echo "need update";


    $sql = 'UPDATE `walletnotes` SET `notes`="'.$_SESSION["walletnotes"].'" WHERE `id` LIKE "%'.$whichmatched.'%"';//1670475715


    $affectedRows = $pdo->exec($sql);
    
if ($affectedRows > 0) {

    echo "succeed";
} else {
    echo " fail";
}

*/

}















        }
    }


        }
    }


   









$output = ob_get_clean();
  } else {

    $output = "you dont have permission to add";
  }





} else {
  $output = "not logged in";
}

   include __DIR__ . '/templates/layout.html.php';


   ?>





<style type='text/css'>

html,
body {
	
}

h1 {

color: white;

}

a:link {
  color: white;
}

/* visited link */
a:visited {
  color: white;
}

/* mouse over link */
a:hover {
  color: yellow;
}

/* selected link */
a:active {
  color: red;
}


body {
	margin: 0;
 
	background: linear-gradient(45deg, #000000, #000000);
	font-family: sans-serif;
	font-weight: 100;
}

.container1 {
	position: absolute;
	top: 300px;
	left: 55px;
	transform: translate(-900px, 45px);
}
.container2 {
	position: absolute;
	top: 100px;
	left: 222px;
	transform: translate(100px, 0%);
}

.table1 {
	width: 1100px;
	border-collapse: collapse;
	overflow: hidden;
	box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.table2 {
	width: 1300px;
	border-collapse: collapse;
	overflow: hidden;
	box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

th,
td {
	padding: 15px;
	background-color: rgba(255,255,255,0.2);
	color: #fff;
}

th {
	text-align: left;
}
thead th {
background-color: #55608f;
}

.chugga {

background-color: #55608f;
}


.chugga3 {

background-color: 'black';
color:white;
}



tbody tr:hover {
background-color: rgba(255,255,255,0.3);
}

tbody td { 
    position:relative; 
    
}

p {
    color:white;
}

label {
    color:white;
}
footer {
    color:white;
}

.bugga {
  border: 5em;
  cursor: pointer;
  outline: none;
  font-size: 16px;
  -webkit-transform: translate(0);
  transform: translate(0);
  background-color: #0e0e10;
  padding: 0.7em 2em;
  border-radius: 65px;
  box-shadow: 1px 1px 10px rgba(255, 255, 255, 0.438);
  -webkit-transition: box-shadow 0.25s;
  transition: box-shadow 0.25s;
  color: white;
}

.bugga .text {
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: white;
  color: white;
  background-image: linear-gradient(45deg, #4568dc, #b06ab3);
}

.bugga:hover {
  background-image: linear-gradient(-45deg, #bdd6ff, #bdd6ff);
  box-shadow: 0 12px 24px rgba(128, 128, 128, 0.1);
  color:black;
}

.bugga:hover .text {
  background-image: linear-gradient(-45deg, #4568dc, #b06ab3);
}

.bugga2 {
  border: 5em;
  cursor: pointer;
  outline: none;
  font-size: 16px;
  -webkit-transform: translate(0);
  transform: translate(0);
  background-color: #bdd6ff;
  padding: 0.7em 2em;
  border-radius: 65px;
  box-shadow: 1px 1px 10px rgba(255, 255, 255, 0.438);
  -webkit-transition: box-shadow 0.25s;
  transition: box-shadow 0.25s;
  color: black;
  text-align:center;


  transform: translate(0, 20px);

}

.modulomo {
	font-family: sans-serif;
padding:5px;
width:500px;
height:210px;
background-color:#546896;
    
	transform: translate(0, -50px);
}
.bugga2 .text {
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: white;
  color: black;
  background-image: linear-gradient(45deg, #bdd6ff, #bdd6ff);
}

.bugga2:hover {
  background-image: linear-gradient(-45deg, #7aadff, #7aadff);
  box-shadow: 0 12px 24px rgba(128, 128, 128, 0.1);
  color:black;
}

.bugga2:hover .text {
  background-image: linear-gradient(-45deg, #7aadff, #7aadff);
}

.txtarae {
resize: none;
text-align:center;

}

.prettytext {

    


}

</STYLE>