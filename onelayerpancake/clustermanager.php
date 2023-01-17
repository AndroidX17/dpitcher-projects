<?php
session_start();
$countsearch = 0;

if ($_POST['COUNTSEARCHES']) {
      
    
    $countsearch = 1;


}

$needmerge = false;
$detectproblem = 0;

if ($_POST['DETECTPROBLEM']) {
      
    
    $detectproblem = 1;


}

function getClusterKeyAndSearchednessFromWallet($wallet, $pdo) {

    $clusterkeys = "";
    $searchednessss = "";
    $sql = "SELECT addresses_in_clusters.clusterkey, address_helped_cluster.searched
    FROM addresses_in_clusters
    INNER JOIN address_helped_cluster
    ON addresses_in_clusters.address = address_helped_cluster.address
    WHERE addresses_in_clusters.address = '".$wallet."';";
    
    $reults = $pdo->query($sql);
    $count = 0;
    foreach($reults as $resuo) {
    $count = $count + 1;
      $clusterkeys = $resuo['clusterkey'];
      $searchednessss = $resuo['searched'];
    
    
    }
    
    
    
    
    
    $finalarray = array();
    array_push($finalarray, $clusterkeys);
    array_push($finalarray, $searchednessss);
    array_push($finalarray, $count);
    
      return $finalarray;
    }
    

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


function getClusterSize($keyforcluster, $pdo) {


$sql5 = 'SELECT * FROM `addresses_in_clusters` WHERE `clusterkey` = "'.$keyforcluster.'"';

$resultss = $pdo->query($sql5);


$sizeofcluster = -1;

$counter = 0;
foreach ($resultss as $resultentry) {
$counter = $counter + 1;

    $currentresultaddress = $resultentry['address'];



}




$sizeofcluster = $counter;




return $sizeofcluster;



}

function isAddressSearched($someaddress, $pdo) {

    $searchid = -1;


    $sql5 = 'SELECT * FROM `address_helped_cluster` WHERE `address` LIKE "%'.$someaddress.'%"';
    
    $resultss = $pdo->query($sql5);
    
 
     foreach ($resultss as $resultor) {

        $searchid = $resultor['searched'];
     }

  return $searchid;

}



function getUnsearchedComrade($keyforcluster, $pdo) {


    $sql5 = 'SELECT * FROM `addresses_in_clusters` WHERE `clusterkey` LIKE "%'.$keyforcluster.'%"';
    
    $resultss = $pdo->query($sql5);
    
    $addressesAsArray = array();
    $addressesSearchedAsArray = array();
$unsearchedComrade = "";

    $sizeofcluster = -1;
    
    $counter = 0;
    foreach ($resultss as $resultentry) {
    $counter = $counter + 1;
    
        $currentresultaddress = $resultentry['address'];
        $searchedness = isAddressSearched($currentresultaddress, $pdo);
    array_push($addressesAsArray, $currentresultaddress);

    if ($searchedness === "1") {

    } else {
    array_push($addressesSearchedAsArray, $searchedness);

$unsearchedComrade = $currentresultaddress;


return $unsearchedComrade;


}


    }
    

    
    
    
    
    return $unsearchedComrade;
    
    
    
    }


    function getOutstandingSearches2($keyforcluster, $pdo) {


        $sql5 = 'SELECT t1.address
        FROM `addresses_in_clusters` t1
        INNER JOIN `address_helped_cluster` t2
        ON t1.address = t2.address
        WHERE t1.clusterkey = '.$keyforcluster.' AND t2.searched = 0';

// mush the tables together and find where the thing in table one exists and the thing in table two you want exists
        
        
        $resultss = $pdo->query($sql5);
        
$count = $resultss->rowCount();
        /*
        $addressesAsArray = array();
        $addressesSearchedAsArray = array();
    
    
        $sizeofcluster = -1;
        
        $counter = 0;
        foreach ($resultss as $resultentry) {
        $counter = $counter + 1;
        
            $currentresultaddress = $resultentry['address'];
            $searchedness = isAddressSearched($currentresultaddress, $pdo);
        array_push($addressesAsArray, $currentresultaddress);
    
        if ($searchedness === "1") {
    
        } else {
        array_push($addressesSearchedAsArray, $searchedness);
    
    
    
    }
    
    
        }
        
    
        $addressesThatNeedSearching = array();
    
        for ($x=0;$x<sizeof($addressesSearchedAsArray);$x++) {
    
         
    
    array_push($addressesThatNeedSearching, $addressesSearchedAsArray);
    
        }
        
        
            */
        
        
        return $count;
    
        
        
        }
    
    

function getOutstandingSearches($keyforcluster, $pdo) {


    $sql5 = 'SELECT * FROM `addresses_in_clusters` WHERE `clusterkey` = "'.$keyforcluster.'"';
    
    $resultss = $pdo->query($sql5);
    
    $addressesAsArray = array();
    $addressesSearchedAsArray = array();


    $sizeofcluster = -1;
    
    $counter = 0;
    foreach ($resultss as $resultentry) {
    $counter = $counter + 1;
    
        $currentresultaddress = $resultentry['address'];
        $searchedness = isAddressSearched($currentresultaddress, $pdo);
    array_push($addressesAsArray, $currentresultaddress);

    if ($searchedness === "1") {

    } else {
    array_push($addressesSearchedAsArray, $searchedness);



}


    }
    

    $addressesThatNeedSearching = array();

    for ($x=0;$x<sizeof($addressesSearchedAsArray);$x++) {

     

array_push($addressesThatNeedSearching, $addressesSearchedAsArray);

    }
    
    
    
    
    
    return sizeof($addressesSearchedAsArray);
    
    
    
    }





if (isset($_SESSION["useruid"])) {



try {

  require_once '../keys/storage.php';


//$sql = 'UPDATE registration SET firstName="bob" WHERE firstName LIKE "%test%"';
// adjusts any X with Y


//$affectedRows = $pdo->exec($sql);

$title = "basic page";
//$output = 'Database connection established.  ' . 'Updated ' . $affectedRows .' rows.';
$output = '<p>Database connection established.  </p>';

$sql2 = 'SELECT `id`,`clusterkey`,`active` FROM `clusters`';

// $sql2 = 'SELECT `concept` FROM `concepts`';



$clusters = $pdo->query($sql2);
//$result = $pdo->query($sql2);

$output2 = '';

/*
$clustersasarray = [];
while($clustersasarray = mysqli_fetch_array($clusters))
{
    $clustersasarray[] = $clustersasarray;
}


*/

/*
$arrays = array();

while($row = mysqli_fetch_assoc($clusters)) {
    $arrays[] = $row;
}
*/


$sql55 = "SELECT * FROM `clusters`";
$resulty = mysqli_query($conn2, $sql55);
$clustersAsArray = array();

while($row = mysqli_fetch_assoc($resulty)) {
    $clustersAsArray[] = $row;
}





//$array = $clusters->fetch_all();

$clustersizes = array();

/*
while ($row = $result->fetch()) {
    $names[] = $row['firstName'];
  }*/
  $clusters2 =  $pdo->query($sql2);
$count2 = 0;
  foreach ($clusters2 as $rows) {
$count2 = $count2 + 1;








  //  $concepts[] = $row['concept'];
  }
//
/*
  for ($x=0;$x<sizeof($clustersAsArray);$x++) {



   // array_push($clustersizes, getClusterSize($rows['clusterkey'], $pdo));

array_push($clustersizes, "hummus".$x);


  }*/

  /*
  foreach($clustersAsArray as $elementimposter) {
    echo $elementimposter . "<br>";

$elemntsize = getClusterSize($elementimposter['clusterkey'], $pdo);


$elementimposter['clustersize']='wagon';

//array_push($element, "clustersize", "1");

// Add a new column
//$elemntsize[] = "clustersize";

// Add a value to the first row
//$elemntsize[] = "1";

//array_push($element, "clustersize => ".$elemntsize."");




}*/




for ($x=0;$x<sizeof($clustersAsArray);$x++) {

    $elemntsize = getClusterSize($clustersAsArray[$x]['clusterkey'], $pdo);


    
  //  $firsttosearch = getUnsearchedComrade($clustersAsArray[$x]['clusterkey'], $pdo);
    $unsearchedComradeAddress = getUnsearchedComrade($clustersAsArray[$x]['clusterkey'], $pdo);
    $clustersAsArray[$x]['clustersize'] = $elemntsize;

    if ($detectproblem === 1) {

    $totalbroken = getAddressesThatNeedToBeAdded($clustersAsArray[$x]['clusterkey'], $pdo);

    $totalbrokencount = sizeof($totalbroken);

 
 
    $clustersAsArray[$x]['totalbroken'] = $totalbrokencount;
}



    if ($countsearch === 1) {
        
      //  $outstandingmembers = getOutstandingSearches($clustersAsArray[$x]['clusterkey'], $pdo);
        $outstandingmembers = getOutstandingSearches2($clustersAsArray[$x]['clusterkey'], $pdo);

    $clustersAsArray[$x]['searches'] = $outstandingmembers;
    }


    $clustersAsArray[$x]['comrades'] = $unsearchedComradeAddress;

}



//print_r($clustersAsArray);




/*
foreach ($clusters as $clusterz) {
    
}
  */


//array_push($clusters['clustersize'], 'location' => 'New York');

//$concepts = $result;

//echo "<font style='font-size:22px;font-color:black;'>Search wallet notes</font><BR>"


$output = $output.'<p class="heading">Manage Clusters</p>';
$output = $output.'<p>There are '.$count2.' total clusters.</p>';


if (isset($_POST["SEARCHCLUSTER"])) {
  
    if ($_POST["SEARCHCLUSTER"]) {
$output = $output.'<p> searched clusters  for : '.$_POST["SEARCHCLUSTER"].'</p>';

$resultsOfNewQuery  = getClusterKeyAndSearchednessFromWallet($_POST["SEARCHCLUSTER"], $pdo);


$keysss = $resultsOfNewQuery[0];
$searccch = $resultsOfNewQuery[1];
$knownstatus = $resultsOfNewQuery[2];
$apends = "";
if ($knownstatus === 0) {

    
$output = $output."<p>UNKNOWN WALLET</p>";
} else {

if ($searccch === "0") {
$apends = " NOT YET SEARCHED";

} else {

    $apends = " & ALREADY SEARCHED";


}
if ($knownstatus === "") {

    $output = $output."<p>BLANK</p>";

} else {
    if ($knownstatus === null) {
        
    $output = $output."<p>UNKNOWN WALLETOID</p>";
    } else {


        $output = $output."<p>KNOWN WALLET FROM CLUSTER ".$keysss.$apends."</p>";
    }

}
}


    }
}



$output = $output.'<p class="heading">View and delete clusters</p>';


if ($_GET["error"] == "merge") {


 

    $needmerge = true;
} 

  ob_start();
  include __DIR__ . '/templates/clustersresults.html.php';
  $output2 = ob_get_clean();

  if (isset($_POST["DETECTPROBLEM"])) {
  
    if ($_POST["DETECTPROBLEM"] == "1") {


  $output = $output."<p>We checked for problems</p>";

    }
}
if (isset($_GET["error"])) {
  
    if ($_GET["error"] == "success") {


        $output = $output."<p>successfully deleted</p>";
    } else if ($_GET["error"] == "error7") {

        $output = $output."<p>you searched a nothing</p>";
  //  } else if ($_GET["error"] == "invalidemail") {

  //      echo "<p>Choose a proper email!</p>";
    }  else if ($_GET["error"] == "rootsucceed") {

        $output = $output."<p>root address attribution succeed</p>";
  //  } else if ($_GET["error"] == "invalidemail") {

  //      echo "<p>Choose a proper email!</p>";
    } else if ($_GET["error"] == "error6") {

        $output = $output."<p>error6</p>";
  }else if ($_GET["error"] == "executed") {

    $output = $output."<p>the fix was executed</p>";
} else if ($_GET["error"] == "nomerge") {

    $output = $output."<p>there is not a merge opportunity</p>";
} else if ($_GET["error"] == "merge") {


 

    $output = $output."<p>there is a merge opportunity</p>";
} else if ($_GET["error"] == "nomatch") {

    $output = $output."<p>no match found</p>";
} else if ($_GET["error"] == "validation") {

    $output = $output."<p style='color:#a1ffba'>Successfully validated data</p>";
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
  }
   include __DIR__ . '/templates/layout.html.php';

  // include __DIR__ . '/templates/formresults.html.php';
   ?>