<?php








if (isset($_POST["serverIP"])) {




    $unity = true;
    $login = true;
    
    
    require_once '../../keys/storage.php';
    

    $findserverIP = "SELECT `serverip`, `serverport`, `active` FROM `server_settings`";
    
    $servercheck = mysqli_query($conn, $findserverIP) or die("2: server check query failed"); // error code 2 = name check query failed
    



if (mysqli_num_rows($servercheck) != 1) {
echo "5: failed to login, missing datas";
exit();

}

// get login info from query

$existinginfo = mysqli_fetch_assoc($servercheck);




echo "0\t".$existinginfo["serverip"]."\t".$existinginfo["serverport"]."\t".$existinginfo["active"];
exit();


}

echo "7: uh oh";
exit();