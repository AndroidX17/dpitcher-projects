<?php








if (isset($_POST["item_name"])) {




    $unity = true;
    $login = true;
    
    $username = $_POST["username"];
    $itemname = $_POST["item_name"];
    $itemamount = $_POST["item_amount"];
    
    require_once '../../keys/storage.php';
    

    
    $sql = "SELECT pi.quantity
    FROM player_items pi
    JOIN players p ON pi.player_id = p.id
    JOIN item i ON pi.item_id = i.id
    WHERE p.username = '".$username."' AND i.item_name ='".$itemname."';";
    

/*

$sql = "SELECT pi.quantity
FROM player_items pi
JOIN players p ON pi.player_id = p.id
JOIN items i ON pi.id = i.id
WHERE p.username = :username AND i.item_name = :itemname;";



$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username);
$stmt->bindValue(':itemname', $itemname);
*/

$results = $pdo->query($sql);

$quantityknown = 0;
$totalfound = 0;
foreach ($results as $resulto) {

$totalfound += 1;

$quantityknown = intval($resulto['quantity']);


}

$quantityknown -= intval($itemamount);

if ($quantityknown < 0) {
    $quantityknown = 0;
}
if ($totalfound == 0) {






} else {

    $sql2 = "UPDATE `player_items` SET quantity = '".$quantityknown."' WHERE `player_id` = (SELECT `id` FROM `players` WHERE username = '".$username."') AND  `item_id` = (SELECT `id` FROM `item` WHERE item_name = '".$itemname."');";

    $stmt2 = $pdo->prepare($sql2);

    $stmt2->execute();


}



/*
   
    $sql = 'INSERT INTO `player_items` SET `type` = :type, `posX` = :posX, `posY` = :posY, `posZ` = :posZ, `rotX` = :rotX, `rotY` = :rotY, `rotZ` = :rotZ, `rotQ` = :rotQ, `hp` = :hp; SELECT LAST_INSERT_ID();';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':type', $type);
    $stmt->bindValue(':posX', $posX);
    $stmt->bindValue(':posY', $posY);
    $stmt->bindValue(':posZ', $posZ);
    $stmt->bindValue(':rotX', $rotX);
    $stmt->bindValue(':rotY', $rotY);
    $stmt->bindValue(':rotZ', $rotZ);
    $stmt->bindValue(':rotQ', $rotQ);
    $stmt->bindValue(':hp', $hp);
    $stmt->execute();
    $id = $pdo->lastInsertId();*/
// get login info from query
//echo "0";

echo "0\t".$totalfound."\t".$quantityknown;
exit();


} else {

echo "7: uh oh";
exit();

}