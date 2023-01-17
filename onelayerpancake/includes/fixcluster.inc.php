<?php









session_start();



require_once '../../keys/storage.php';


function didThisPersonSearch($memberOfCluster, $pdo) {
   
    $sql1 = 'SELECT * FROM `address_helped_cluster` WHERE `address` LIKE "%'.$memberOfCluster.'%"';

$searchstatus = -1;

$stringresult = "";
    $result = $pdo->query($sql1);
    //$result = $pdo->query($sql2);
 $counter = 0;
    foreach ($result as $entry) {
$counter = $counter + 1;
    }

    if ($counter === 0) {



        $searchstatus = 0;
    } else {
        $searchstatus = 1;
    }
  
return $searchstatus;
}


function addAddressAsUnsearched($wallet, $pdo) {

  
  $sql = 'INSERT INTO `address_helped_cluster` SET `address` = :address, `searched` = :searched';
  
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':address', $wallet);
  $stmt->bindValue(':searched', 0);
  $stmt->execute();
  

}


function getAddressesThatNeedToBeAdded($clusterkey, $pdo) {



    $sql1 = 'SELECT `address` FROM `addresses_in_clusters` WHERE `clusterkey` LIKE "%'.$clusterkey.'%"';

$membersOfCluster = array();

    $result = $pdo->query($sql1);
    //$result = $pdo->query($sql2);
    
    
 
    
    $count = 0;
    foreach ($result as $entry) {
    $count = $count + 1;
    

    array_push($membersOfCluster, $entry['address']);
    
    }

   
$membersOfClusterWhoHelped = array();


foreach ($membersOfCluster as $memberOfCluster) {


$resulto = didThisPersonSearch($memberOfCluster, $pdo);

if ($resulto === 0) {



 array_push($membersOfClusterWhoHelped, $memberOfCluster);

}

} 

return $membersOfClusterWhoHelped;

}
    
    




if (isset($_SESSION["useruid"])) {


    if (isset($_POST["clusterkey"])) {


$clusterkey = $_POST["clusterkey"];

$addressesNeedingAddingAsSearched = getAddressesThatNeedToBeAdded($clusterkey, $pdo);


foreach($addressesNeedingAddingAsSearched as $addressentry) {

addAddressAsUnsearched($addressentry, $pdo);

}




        header("Location: ../clustermanager.php?error=succeed"); // go here
exit();

    } else {



        header("Location: ../clustermanager.php?error=nokey"); // go here


        exit();
    }


} else {


    
header("Location: ../clustermanager.php?error=nologin"); // go here



exit();
}









header("Location: ../clustermanager.php?error=none"); // go here





























