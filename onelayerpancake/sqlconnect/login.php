<?php







$unity = true;
$login = true;


require_once '../../keys/storage.php';



if (isset($_POST["username"])) {

    $username = $_POST["username"];
    $password = $_POST["userpassword"];
    
    $namecheckquery = "SELECT `username`, `salt`, `hash`,`kills`,`funds` FROM `players` WHERE `username` = '".$username."';";
    
    $namecheck = mysqli_query($conn, $namecheckquery) or die("2: name check query failed"); // error code 2 = name check query failed
    
if (mysqli_num_rows($namecheck) != 1) {
echo "5: failed to login, u already logged in or no user";
exit();

}

// get login info from query

$existinginfo = mysqli_fetch_assoc($namecheck);

$salt = $existinginfo["salt"];
$hash = $existinginfo["hash"];

$loginhash = crypt($password, $salt);
if ($hash != $loginhash) {

echo "6: incorrect password";
exit();


}


echo "0\t".$existinginfo["kills"]."\t".$existinginfo["funds"];

} else {

    echo " NO POST";
}







?>