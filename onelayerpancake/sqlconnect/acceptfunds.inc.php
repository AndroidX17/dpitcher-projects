<?php


if (isset($_POST["saleID"])) {
// UPDATE `market_items` SET `quantity` = 1 WHERE `name` = "BIN" AND `price` = 5 AND `level` = 1 AND `seller` = "lepi";
// DELETE FROM `market_items` WHERE `name` = "BIN" AND `price` = 5 AND `level` = 1 AND `seller` = "lepi"
    $unity = true;
    $login = true;
    
$saleID = $_POST["saleID"];
$itemprice = $_POST["price"];
$username = $_POST["username"];
$quantity = $_POST["quantity"];
$level = $_POST["level"];


$quantity = intval($quantity);
$level = intval($level);
$price = intval($price);
$saleID = intval($saleID);


    require_once '../../keys/storage.php';
    




    $query = "SELECT * FROM market_sales WHERE id = '$saleID' AND seller = '$username' AND price = '$itemprice' AND quantity = '$quantity' AND level = '$level'";
    $result = mysqli_query($conn, $query);
    
    // If a match is found, delete the entry and echo the funds gained from the sale
    if (mysqli_num_rows($result) > 0) {
        //$funds = $price * $quantity;
        $delete_query = "DELETE FROM market_sales WHERE id = '$saleID'";
        mysqli_query($conn, $delete_query);
        echo "0";
    } else {
        echo "5Invalid Sale";
    }
    
    // Close the connection
    mysqli_close($conn);
    




        exit();
    } else {
        echo "1";
        exit();
    }


    
    echo "5";
    exit();

