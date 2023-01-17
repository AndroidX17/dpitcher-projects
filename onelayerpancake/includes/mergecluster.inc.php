<?php 



function deleteCluster($mergingCluster, $pdo) {

  $sqls2 = "DELETE FROM `clusters` WHERE `clusterkey` = '".$mergingCluster."';";

  $stmt = $pdo->prepare($sqls2);
   $stmt->execute();
   
}



function updateClusterkey($clusterkey, $pdo, $invincibleCluster) {
    

    $sqlss = "UPDATE `addresses_in_clusters`
    SET `clusterkey` = :clusterkey1
    WHERE `clusterkey` = :clusterkey2;";


    $stmt = $pdo->prepare($sqlss);
   $stmt->bindValue(':clusterkey1', $invincibleCluster);
   $stmt->bindValue(':clusterkey2', $clusterkey);
    $stmt->execute();
    



}

function deleteAddressFromCluster($addresshere, $mergingCluster, $pdo) {



    $sqls1 = "DELETE FROM `addresses_in_clusters` WHERE `address`='".$addresshere."' AND `clusterkey` = '".$mergingCluster."';";

    $stmt = $pdo->prepare($sqls1);
   // $stmt->bindValue(':clusterkey1', $invincibleCluster);
  //  $stmt->bindValue(':clusterkey2', $clusterkey);
     $stmt->execute();
     

}

session_start();



require_once '../../keys/storage.php';






if (isset($_SESSION["useruid"])) {


    if (isset($_POST["clusterkey"])) {




        if ($_SESSION["permissions"] === "SPECIAL") {





/*

            $sql11 = "SELECT `clusterkey`
            FROM `addresses_in_clusters`
            WHERE `address` IN (SELECT `address`
                              FROM `addresses_in_clusters`
                              GROUP BY `address`
                              HAVING COUNT(*) > 1)";*/
            // 44146 + 15 = 44161
            
         //   $result4 = $pdo->query($sql11);
            


         $invincibleCluster = $_POST["clusterkey"];








            $sql12 = "SELECT DISTINCT `clusterkey`
            FROM `addresses_in_clusters`
            WHERE `address` IN (SELECT `address` FROM `addresses_in_clusters` WHERE `clusterkey` = ".$_POST["clusterkey"].")
            AND `clusterkey` <> ".$_POST["clusterkey"].";";



$result5 = $pdo->query($sql12);
 $arrayofresults = array();           
foreach($result5 as $result) {

   // echo $result['clusterkey'];
array_push($arrayofresults, $result['clusterkey']);

}






$sql4 = "SELECT `address`, COUNT(*)
FROM `addresses_in_clusters`
GROUP BY `address`
HAVING COUNT(*) > 1";

$addresshere = "";


$result4 = $pdo->query($sql4);


foreach ($result4 as $record4) {


 $addresshere = $record4['address'];


}

 




foreach ($arrayofresults as $mergingCluster) { // this cycles through the clusters we need to handle




    if ($mergingCluster === $invincibleCluster) {
    
    
    
    
    } else {
    


    
    deleteAddressFromCluster($addresshere, $mergingCluster, $pdo);
    
    }
    
    }
    




foreach ($arrayofresults as $mergingCluster) { // this cycles through the clusters we need to handle


    if ($mergingCluster === $invincibleCluster) {




    } else {


updateClusterkey($mergingCluster, $pdo, $invincibleCluster);



    }

}

    foreach ($arrayofresults as $mergingCluster) { // this cycles through the clusters we need to handle


        if ($mergingCluster === $invincibleCluster) {
    
    
    
    
        } else {
    
    
    deleteCluster($mergingCluster, $pdo);
    
    
    
        }
    }
    
 

    // find all addresses relating to the old clusters

// update all clusterkeys to the new cluster 

// delete the duplicate entry

// delete cluster 16




            header("Location: ../clustermanager.php?error=succeed"); // go here
            exit();
            

        } else {




            header("Location: ../clustermanager.php?error=nospecial"); // go here
            exit();
            

        }



    } else {




        header("Location: ../clustermanager.php?error=fail"); // go here


        exit();


    }
} else {

    header("Location: ../clustermanager.php?error=nologin"); // go here


    exit();


}







header("Location: ../clustermanager.php?error=none"); // go here








