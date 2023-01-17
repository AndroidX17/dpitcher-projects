<?php









session_start();



require_once '../../keys/storage.php';

    function updateRoot($clusterkey, $pdo, $earliestentryaddress) {

        $sql = 'UPDATE `clusters` SET `root`="'.$earliestentryaddress.'" WHERE `clusterkey` = "'.$clusterkey.'";';//1670475715


        $affectedRows = $pdo->exec($sql);
        
return $affectedRows;


    }
    

function getLastseenForAddress($clustermember, $pdo) {

    $currenttimestamp = 0;

$sqls = 'SELECT `lastseen` FROM `address_helped_cluster` WHERE `address` = "'.$clustermember.'";';

$rtesults = $pdo->query($sqls);

$currenttimestamp = "";
foreach ($rtesults as $entry) {

$currenttimestamp = $entry['lastseen'];


}


return $currenttimestamp;

}


if (isset($_SESSION["useruid"])) {

    if ($_SESSION["permissions"] === "SPECIAL") {

    if (isset($_POST["clusterkey"])) {


$clusterkey = $_POST["clusterkey"];

$clustermembers = array();

$sqls = 'SELECT * FROM `addresses_in_clusters` WHERE `clusterkey`="'.$clusterkey.'"';
$resultss = $pdo->query($sqls);
$totalresults = 0;
foreach ($resultss as $result) {
    $totalresults =$totalresults + 1;
$currentmember = $result['address'];

array_push($clustermembers, $currentmember);

}

$earliestentryaddress = "ROOTFAIL";
$earliestentrytimestamp = 9999999999999999999;

if (sizeof($clustermembers) === 0) {

    header("Location: ../clustermanager.php?error=ahh"); // go here
    exit();

}


foreach ($clustermembers as $clustermemberz) {

    $lastseenforclustermember =getLastseenForAddress($clustermemberz, $pdo);

//$currenttimestampASINT = intvar($lastseenforclustermember);
//$earliestentrytimestampasINT = intvar($earliestentrytimestamp);


if ($lastseenforclustermember < $earliestentrytimestamp) {

    $earliestentrytimestamp = $lastseenforclustermember;
    $earliestentryaddress = $clustermemberz;
  
    }

}

if ($earliestentryaddress === "ROOTFAIL") {

    header("Location: ../clustermanager.php?error=rootfail"); // go here
    exit();
    



} else {




$completer = updateRoot($clusterkey, $pdo, $earliestentryaddress);


if ($completer === 0) {

    header("Location: ../clustermanager.php?error=noupdate"); // go here
    exit();

} else {

    header("Location: ../clustermanager.php?error=rootsucceed"); // go here
    exit();

    
}
    header("Location: ../clustermanager.php?error=rootsucceed"); // go here
    exit();
    








}



        header("Location: ../clustermanager.php?error=hmmm"); // go here
exit();

    } else {



        header("Location: ../clustermanager.php?error=nokey"); // go here


        exit();
    }

    } else {
            
header("Location: ../clustermanager.php?error=not special"); // go here



exit();
}
    


    
} else {


    
header("Location: ../clustermanager.php?error=nologin"); // go here



exit();
}









header("Location: ../clustermanager.php?error=none"); // go here





























