<?php





$unity = true;
$saving = true;

require_once '../../keys/storage.php';




if (isset($_POST["score"])) {


    $username = $_POST["scoreusername"];
    $newscore = $_POST["score"];

    $namecheckquery = "SELECT username FROM players WHERE username='".$username."';";

    $namecheck = mysqli_query($conn, $namecheckquery) or die ("2: name check query failed");
if (mysqli_num_rows($namecheck) != 1) {
    echo "5: either no user with name or more than 1";
    exit();
}

$updatequery = "UPDATE players SET kills = ".$newscore." WHERE username = '".$username."';";
mysqli_query($conn, $updatequery) or die("7: SAVE query FAILED");

echo "0";

}















?>