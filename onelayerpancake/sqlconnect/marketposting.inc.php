<?php

if (isset($_POST["item_name"])) {




    $unity = true;
    $login = true;
    
    $itemname = $_POST["item_name"];
    $itemquantity = $_POST["item_quantity"];
    $itemseller = $_POST["item_seller"];
    $itemprice = $_POST["item_price"];
    $itemlevel = $_POST["item_level"];
    
    require_once '../../keys/storage.php';
    

  
    $sql = 'INSERT INTO `market_items` SET `name` = :itemname, `quantity` = :itemquantity, `seller` = :itemseller, `price` = :itemprice, `level` = :itemlevel';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':itemname', $itemname);
    $stmt->bindValue(':itemquantity', $itemquantity);
    $stmt->bindValue(':itemseller', $itemseller);
    $stmt->bindValue(':itemprice', $itemprice);
    $stmt->bindValue(':itemlevel', $itemlevel);
    $stmt->execute();



echo "0";
exit();


} else {

echo "7: uh oh";
exit();

}