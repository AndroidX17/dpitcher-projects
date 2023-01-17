<?php 
$entrynumber = 0;







function doWeGottaMergeThisCluster($currentclusterid, $pdo) {

$somebool = false;





$duplicatesInFirstTable = array();



$sql4 = "SELECT `clusterkey`,`address`, COUNT(*)
FROM `addresses_in_clusters`
GROUP BY `address`
HAVING COUNT(*) > 1";


$sql11 = "SELECT `clusterkey`
FROM `addresses_in_clusters`
WHERE `address` IN (SELECT `address`
                  FROM `addresses_in_clusters`
                  GROUP BY `address`
                  HAVING COUNT(*) > 1)";
// 44146 + 15 = 44161

$result4 = $pdo->query($sql11);



$counter4 = 0;
foreach ($result4 as $record4) {

$counter4 = $counter4 + 1;
    array_push($duplicatesInFirstTable, $record4['clusterkey']);


}



$foundmatch = false;


foreach ($duplicatesInFirstTable as $duplicate) {

   if ($duplicate == $currentclusterid) {
$foundmatch = true;


   }



}

if ($foundmatch === false) {

    $somebool = false;
}
if ($foundmatch === true) {

    $somebool = true;
}




return $somebool;
    


}







function isRootAssignedForCluster($clusterkey, $pdo) {

$rootassigned = false;

$sqll = 'SELECT `root` FROM `clusters` WHERE `clusterkey`="'.$clusterkey.'"';



$resultss = $pdo->query($sqll);
//$result = $pdo->query($sql2);


$rootdata="";

foreach ($resultss as $row) {


    $rootdata = $row['root'];


}


if ($rootdata === null || $rootdata === "" || $rootdata === "UNKNOWN") {

$rootassigned = false;

} else {
$rootassigned = true;


    
}




    return $rootassigned;

}

?>


<DIV style="display: table; width: 50%;">
<form style="display: table-cell; width: 10%;" name="validatesearch" id="validatesearch"  action="includes/validatesearches.inc.php" method="post">


 <input type='Submit' class='bugga3' value='Validate Searched Addresses'>
  </form>




<!--
 <form style="display: table-cell; width: 10%;" name="detectProblem" id="detectProblem"  action="" method="post">


<input type='hidden' value='1' name='DETECTPROBLEM'>
<input type='Submit' value='Detect problems with database'>
</form>
//-->

<form style="display: table-cell; width: 5%;" name="fixdb" id="fixdb"  action="includes/fixdatabase.inc.php" method="post">


<input type='hidden' value='1' name='FIXDATABASE'>
<input type='Submit' class='bugga3' value='FIX DATABASE'>
</form>
<form style="display: table-cell; width: 5%;" name="cleandb" id="cleandb"  action="includes/cleandatabase.inc.php" method="post">


<input type='hidden' value='1' name='CLEANDATABASE'>
<input type='Submit' class='bugga3' value='CLEAN'>
</form>


<form style="display: table-cell; width: 10%;" name="countSearchesNeeded" id="countSearchesNeeded"  action="" method="post">


<input type='hidden' value='1' name='COUNTSEARCHES'>
<input type='Submit' class='bugga3' value='Look up clusters that need expansion'>
</form>


<form style="display: table-cell; width: 10%;" name="checkMerge" id="checkMerge"  action="includes/checkformerge.inc.php" method="post">


<input type='hidden' value='1' name='CHECKMERGE'>
<input type='Submit' class='bugga3' value='Detect for merge opportunity'>
</form>
</DIV>
<BR>

<form style="display: table-cell; width: 10%;" name="searchcluster" id="searchcluster"  action="../clustermanager.php" method="post"><BR>

<input type='Submit' class='bugga3' value='SEARCH CLUSTER'>
<input type='text' value='bc1q36y03h9ak0me88xrw8s9w6afnpqjlde0txufk23ty62h9cy8ka4srwm8w0' size="60" placeholder='bc1q...' name='SEARCHCLUSTER'>
</form>







<?php if (isset($error)): ?>
    <p>
      <?php echo $error; ?>
    </p>



    <?php

session_start();


?>


    <?php else: ?>
    <?php foreach ($clustersAsArray as $cluster): ?>
    <blockquote style="display: table; width:50%; margin-bottom: 1em; border-bottom: 1px solid #ccc; padding: 0.5em;">
      <p style="display: table-cell; width: 70%; vertical-align: top;">
      <?php
    //  echo "<p>";

   // echo "<DIV style='display: table-cell; width:50%;'>";
    echo "CLUSTER ";
      echo htmlspecialchars($cluster['clusterkey'], ENT_QUOTES, 'UTF-8');
       echo "<BR> status: ";
$newoutputword = "";
if ($cluster['active'] === "1") {

    $newoutputword = " active cluster ";
}
if ($cluster['active'] === "0") {

    $newoutputword = " disabled cluster ";

}
echo $newoutputword;


echo ", cluster size: ".$cluster['clustersize']; //.",  entry number".$entrynumber;
//echo "cluster size: ".$clustersizes[$entrynumber]."  entry number".$entrynumber;




    echo ", root: ".$cluster['root']; //.",  entry number".$entrynumber;
    //echo "cluster size: ".$clustersizes[$entrynumber]."  entry number".$entrynumber;
    
    






if ($cluster['searches']) {

echo ", searches needed: ".$cluster['searches'];




} else {


if (isset($_POST['COUNTSEARCHES'])) {




    require_once '../keys/storage.php';

$rootwasassigned = isRootAssignedForCluster($cluster['clusterkey'], $pdo);

if ($rootwasassigned === false) {

    $formname2= "completecluster".$cluster['id'];

    echo '<form style="display: table-cell; width: 10%;" name="'.$formname2.'" id="'.$formname2.'"  action="/includes/completecluster.inc.php" method="post">';
    echo '<input type="hidden" name="clusterkey" value="'. $cluster['clusterkey'] . '">';
 
//echo '<p>beef salad</p>';
    $msgg2 = "&quot;Assign root?&quot;";
    //echo "<input type='button' value='Delete' onclick='var hatever = confirm(".$msgg."); if (hatever) { document.getElementById(\'deletecluster".$cluster['id']."\').submit(); }'>";
    echo "<input type='button' class='bugga4' value='Assign root?' onclick='var test = confirm(".$msgg2.");if (test) { document.getElementById(\"".$formname2."\").submit(); }'>";
    echo '  </form>&nbsp;';
    
} 
}





if ($needmerge === true) {

    
    require_once '../keys/storage.php';


$currentclusterid = $cluster['clusterkey'];

$doesThisNeedMerging = doWeGottaMergeThisCluster($currentclusterid, $pdo);

if ($doesThisNeedMerging === false) {

//echo '<p> PINECAKE </p>';
} else {

    $formname3= "mergecluster".$cluster['id'];


    echo '<form style="display: table-cell; width: 10%;" name="'.$formname3.'" id="'.$formname3.'"  action="/includes/mergecluster.inc.php" method="post">';
    echo '<input type="hidden" name="clusterkey" value="'. $cluster['clusterkey'] . '">';
 
//echo '<p>beef salad</p>';
    $msgg3 = "&quot;Merge all others sharing wallets into this cluster?&quot;";
    //echo "<input type='button' value='Delete' onclick='var hatever = confirm(".$msgg."); if (hatever) { document.getElementById(\'deletecluster".$cluster['id']."\').submit(); }'>";
    echo "<input type='button' class='bugga4' value='Merge?' onclick='var test = confirm(".$msgg3.");if (test) { document.getElementById(\"".$formname3."\").submit(); }'>";
    echo '  </form>&nbsp;';
}

}









}




    ?>
</p>
<p style="display: table-cell; width: 40%; vertical-align: top;">
    <?php







if ($_SESSION["permissions"] === "SPECIAL") {


    if ($cluster['totalbroken']) {


    $formname= "fixcluster".$cluster['id'];

    
$info = $cluster['totalbroken'];

if ($info > 0) {




    $msgg = "&quot;Fix cluster?&quot;";
echo '<form style="display: table-cell; width: 10%;" name="'.$formname.'" id="'.$formname.'"  action="includes/fixcluster.inc.php" method="post">';
echo '<input type="hidden" name="clusterkey" value="'. $cluster['clusterkey'] . '">';



echo "<input type='submit' value='FIX".$info."' >";



//echo "<input type='button' value='FIX' onclick='var test = confirm(".$msgg.");if (test) { document.getElementById(\"".$formname."\").submit(); }'>";
echo '  </form>';

}

    }




}


if ($_SESSION["permissions"] === "SPECIAL") {








    $formname= "searchcluster".$cluster['id'];

    




    echo '<form style="display: table-cell; width: 10%;" name="'.$formname.'" id="'.$formname.'"  action="../bitcoin2.php" method="post">';
    echo '<input type="hidden" name="cryptowallet" value="'. $cluster['comrades'] . '">';
    echo '<input type="hidden" name="postoffset" value="1">';
    echo '<input type="hidden" name="lasthash" value="">';
    echo '<input type="hidden" name="lastpage" value="1">';
    echo '<input type="hidden" name="usehash" value="0">';
    echo '<input type="hidden" name="currentpage" value="1">';
    echo '<input type="hidden" name="CANCLUSTER" value="1">';

    $msgg = "&quot;Expand cluster?&quot;";
    //echo "<input type='button' value='Delete' onclick='var hatever = confirm(".$msgg."); if (hatever) { document.getElementById(\'deletecluster".$cluster['id']."\').submit(); }'>";
    echo "<input type='button' class='bugga4' value='Expand cluster' onclick='var test = confirm(".$msgg.");if (test) { document.getElementById(\"".$formname."\").submit(); }'>";
    echo '  </form>&nbsp;';
    
          }

          
$entrynumber = $entrynumber + 1;
     // echo htmlspecialchars($newoutputword, ENT_QUOTES, 'UTF-8');
      $formname= "deletecluster".$cluster['id'];
      $notdeleted = "Delete [cancelled]";
     // echo "</p>";
     if ($_SESSION["useruid"] === "admin") {
      if ($_SESSION["permissions"] === "SPECIAL") {
$msgg = "&quot;Delete entry?&quot;";
echo '<form style="display: table-cell; width: 10%;" name="'.$formname.'" id="'.$formname.'"  action="deletecluster.php" method="post">';
echo '<input type="hidden" name="id" value="'. $cluster['id'] . '">';
echo '<input type="hidden" name="clusterkey" value="'. $cluster['clusterkey'] . '">';
//echo "<input type='button' value='Delete' onclick='var hatever = confirm(".$msgg."); if (hatever) { document.getElementById(\'deletecluster".$cluster['id']."\').submit(); }'>";
echo "<input type='button' class='bugga5' value='Delete' onclick='var test = confirm(".$msgg.");if (test) { document.getElementById(\"".$formname."\").submit(); }'>";
echo '  </form>';

      }
    }
      
//echo "</DIV>";

      ?>




      

    
    







      </p>
    </blockquote>
    <?php endforeach; ?>
    <?php endif; ?>
    
    <?php echo $output2; ?>