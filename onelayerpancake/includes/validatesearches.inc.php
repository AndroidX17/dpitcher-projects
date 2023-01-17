<?php





$post1 = 0;
$post2 = 0;
$post3 = 0;
$post4 = 0;

$totalcode = "";

session_start();



require_once '../../keys/storage.php';


if (isset($_SESSION["useruid"])) {




$extraEntriesInSearchedAddresses = array();


$sql = "SELECT * FROM `address_helped_cluster` WHERE `address` NOT IN (SELECT `address` FROM `addresses_in_clusters`)";

$result = $pdo->query($sql);



$counter = 0;
foreach ($result as $record) {

$counter = $counter + 1;
    array_push($extraEntriesInSearchedAddresses, $record['address']);

}

if ($counter === 0) {





    //header("Location: ../clustermanager.php?error=validation"); // go here
$totalcode = $totalcode."there were no entries present in the first table that werent in the second";
//echo "there were no entries present in the first table that werent in the second";
$post1 = 1;

    //exit();


} else {


    foreach ($extraEntriesInSearchedAddresses as $extraEntriesInSearchedAddress) {

        
$totalcode = $totalcode."these are present in the second table but missing from the first<BR>";

$totalcode = $totalcode.$extraEntriesInSearchedAddress."<BR>";
//echo "these are present in the second table but missing from the first<BR>";
     //   echo $extraEntriesInSearchedAddress."<BR>";
    }


}


$extraEntriesInClusteredAddresses = array();


$sql2 = "SELECT * FROM `addresses_in_clusters` WHERE `address` NOT IN (SELECT `address` FROM `address_helped_cluster`)";

$result2 = $pdo->query($sql2);



$counter2 = 0;
foreach ($result2 as $record2) {

$counter2 = $counter2 + 1;
    array_push($extraEntriesInClusteredAddresses, $record2['address']);

}

if ($counter2 === 0) {


    $totalcode = $totalcode."there were no entries present in the 2nd table that werent in the 1st";
   // echo "there were no entries present in the 2nd table that werent in the 1st";



   // header("Location: ../clustermanager.php?error=validation2"); // go here

   $post2 = 1;

   // exit();


} else {


    foreach ($extraEntriesInClusteredAddresses as $extraEntriesInClusteredAddress) {
        $totalcode = $totalcode."these are present in the first table but missing from the second<BR>";
 
        $totalcode = $totalcode.$extraEntriesInClusteredAddress."<BR>";
 
//echo "these are present in the first table but missing from the second<BR>";
       // echo $extraEntriesInClusteredAddress."<BR>";
    }


}


$duplicatesInSecondTable = array();



$sql3 = "SELECT `address`, COUNT(*)
FROM `address_helped_cluster`
GROUP BY `address`
HAVING COUNT(*) > 1";



$result3 = $pdo->query($sql3);



$counter3 = 0;
foreach ($result3 as $record3) {

$counter3 = $counter3 + 1;
    array_push($duplicatesInSecondTable, $record3['address']);


}



if ($counter3 === 0) {


    $post3 = 1;
  //  echo "<BR> no duplicates in the 2nd table<BR>";
    $totalcode = $totalcode."<BR> no duplicates in the 2nd table<BR>";

} else {

   // echo "duplicates in the second table:<BR>";

    $totalcode = $totalcode."duplicates in the second table:<BR>";
  $totalcode = $totalcode.print_r($duplicatesInSecondTable, true);

}





$duplicatesInFirstTable = array();



$sql4 = "SELECT `address`, COUNT(*)
FROM `addresses_in_clusters`
GROUP BY `address`
HAVING COUNT(*) > 1";



$result4 = $pdo->query($sql4);



$counter4 = 0;
foreach ($result4 as $record4) {

$counter4 = $counter4 + 1;
    array_push($duplicatesInFirstTable, $record4['address']);


}



if ($counter4 === 0) {


    $post4 = 1;
   // echo "<BR> no duplicates in the 1st table<BR>";
    $totalcode = $totalcode."<BR> no duplicates in the 1st table<BR>";
} else {

   // echo "duplicates in the 1st table:<BR>";

   $totalcode = $totalcode."duplicates in the 1st table:<BR>";
   $totalcode = $totalcode.print_r($duplicatesInFirstTable, true);


}



$makedump =0;

if ($post1 === 1) {
    if ($post2 === 1) {
        if ($post3 === 1) {
            if ($post4 === 1) {




                $makedump =1;

header("Location: ../clustermanager.php?error=validation"); // go here

            }
        }
    }
}

if ($makedump ===0) {
echo $totalcode;

}
/*



if ($counter3 === 0) {



if ()


} else {
    echo "duplicatesInSecondTable <BR>";

    foreach ($duplicatesInSecondTable as $duplicatesInSecondTabless) {

        echo $duplicatesInSecondTabless."<BR>";
    }







*/


















}







exit();

//header("Location: ../clustermanager.php?error=validation"); // go here





























