<?php








if (isset($_POST["username"])) {




    $unity = true;
    $login = true;
    
    $username = $_POST["username"];
    
    require_once '../../keys/storage.php';
    
    
$sql = "SELECT t3.*
FROM `player_items` t3
JOIN `players` t1 ON t1.id = t3.player_id
WHERE t1.username = '".$username."';";

$results = $pdo->query($sql);

$totalrow = 0;

$allvalues = "";

$sql2 = "SELECT `id`,`item_name` FROM `item`;";
$results2 = $pdo->query($sql2);

$arrayofresults = $results2->fetchAll(); 



foreach($results as $resulto) {

$totalrow += 2;

$id1 = $resulto['item_id'];


foreach($arrayofresults as $thinginarray) {


if ($thinginarray[0] == $id1) {
$itemname = $thinginarray[1];

}

}
//$itemname = $arrayofresults[intval($id1)];

$quan = $resulto['quantity'];


$allvalues = $allvalues."\t".$itemname."\t".$quan;
//print_r($itemname, true)
}



    
echo "0\t".$totalrow."\t".$allvalues;
exit();


} else {

echo "7: uh oh";
exit();

}