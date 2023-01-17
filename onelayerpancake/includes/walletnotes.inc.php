<?php

session_start();





if (isset($_SESSION["useruid"])) {

    if ($_SESSION["permissions"] === "SPECIAL") {
  

if (isset($_POST["wallet"])) {


    if ($_POST["wallet"]) {
$newwallet = $_POST["wallet"];

if (isset($_POST["walletnotes"])) {


    if ($_POST["walletnotes"]) {


        $newnotes = $_POST["walletnotes"];

        $foundquery= true;

        
require_once '../../keys/storage.php';

$newwallet = trim($newwallet, " ");


$admission = false;
if (substr($newwallet, 0, 1) === "b") {
    $admission = true;

}
if (substr($newwallet, 0, 1) === "1") {
    $admission = true;

}
if (substr($newwallet, 0, 1) === "3") {
    $admission = true;

}

if ($admission === false) {

    
header("location: ../walletnotes.php?error=notwallet");



exit();

}







$sql5 = 'SELECT `id`,`wallet`,`note` FROM `new_walletnotes` WHERE `wallet` LIKE "%'.$newwallet.'%"';

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

//echo "<P>".$counter."</P>";

//$currenttime = date();

/*
$stmt = $conn->prepare("INSERT INTO `walletnotes` (wallet, notes, timestamp)
VALUES (?, ?, ?)");
*/

//$stmt->bind_param("sss",$newwallet, $newnotes, $currenttime);
//$stmt->execute();


if ($counter === 0) {


//echo "<P>new</P>";


if ($conn === null) {

   // echo "<P>aaa</P>";

}
// newwallet, newnotes
$newwallet = trim($newwallet, " ");
//$sql = 'INSERT INTO new_walletnotes (wallet, note) VALUES (?,?)';
$sql = 'INSERT INTO `new_walletnotes` SET `wallet` = :wallet, `note` = :note';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':note', $newnotes);
$stmt->bindValue(':wallet', $newwallet);
$stmt->execute();
//"<P>new".$newwallet."</P>";
//echo "<P>new".$newnotes."</P>";
//echo "<P>new</P>";

//mysqli_stmt_bind_param($stmt, "ss", "test", "test");

//echo "<P>win</P>";
/*
mysqli_stmt_bind_param($stmt, "sss", $newwallet, $newnotes, "test");

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
header("location: ../walletnotes.php?error=fail");
exit();

}
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


header("location: ../walletnotes.php?error=succeed");



exit();

} else {



   // $sql = 'UPDATE `new_walletnotes` SET `note`="'.$newnotes.'" WHERE `wallet` LIKE "%'.$newwallet.'%"';//1670475715

    $sql = 'UPDATE `new_walletnotes` SET `note`="'.$newnotes.'" WHERE `wallet` LIKE "%'.$newwallet.'%"';//1670475715


$affectedRows = $pdo->exec($sql);

if ($affectedRows > 0) {



    header("location: ../walletnotes.php?error=updatedit1");
    exit();
    


} else {



    header("location: ../walletnotes.php?error=updatedit2");
    exit();
    



}





header("location: ../walletnotes.php?error=updatedit");
exit();



}















    } else {



        header("location: ../walletnotes.php?error=nonote");
        exit();

    }
}


    }
}





header("location: ../walletnotes.php?error=emptyinput");






    }
}


