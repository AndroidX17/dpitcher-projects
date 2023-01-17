<?php


if (isset($_POST["item_name"])) {
// UPDATE `market_items` SET `quantity` = 1 WHERE `name` = "BIN" AND `price` = 5 AND `level` = 1 AND `seller` = "lepi";
// DELETE FROM `market_items` WHERE `name` = "BIN" AND `price` = 5 AND `level` = 1 AND `seller` = "lepi"
    $unity = true;
    $login = true;
    
$name = $_POST["item_name"];
$quantity = $_POST["item_quantity"];
$itembuyer = $_POST["item_buyer"];
$price = $_POST["item_price"];
$enhancement_level = $_POST["item_level"];
$quantity = intval($quantity);
$enhancement_level = intval($enhancement_level);
$price = intval($price);
    require_once '../../keys/storage.php';
    


    $query = "SELECT * FROM `market_items` WHERE `name` = :name AND `price` = :price AND `level` = :enhancement_level AND `seller` != :buyer_name";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(':name' => $name, ':price' => $price, ':enhancement_level' => $enhancement_level, ':buyer_name' => $itembuyer));
    $result = $stmt->fetch();


$seller = $result['seller'];


    if ($result['quantity'] >= $quantity) {

  $newquery = null;

  $new_quantity = $result['quantity'] - $quantity;
  if ($new_quantity == 0) {
      $newquery = "DELETE FROM `market_items` WHERE `name` = :name AND `price` = :price AND `level` = :enhancement_level AND `seller` = :seller"; 
      $stmt2 = $pdo->prepare($newquery);
      $stmt2->bindParam(':name', $name);
      $stmt2->bindParam(':price', $price);
      $stmt2->bindParam(':enhancement_level', $enhancement_level);
      $stmt2->bindParam(':seller', $seller);
  } else {
      $newquery = "UPDATE `market_items` SET `quantity` = :new_quantity WHERE `name` = :name AND `price` = :price AND `level` = :enhancement_level AND `seller` = :seller";
      $stmt2 = $pdo->prepare($newquery);
      $stmt2->bindParam(':name', $name);
      $stmt2->bindParam(':price', $price);
      $stmt2->bindParam(':enhancement_level', $enhancement_level);
      $stmt2->bindParam(':seller', $seller);
      $stmt2->bindParam(':new_quantity', $new_quantity);
  }

  if ($newquery == null) {

 echo "5";
 exit();

  }
  
  try {
      $stmt2->execute();
  } catch (PDOException $e) {
      echo "5".$e->getMessage();
  }
  



        /*
        try {

            $stmt2 = $pdo->prepare($newquery);

            $stmt2->bindParam(':name', $name);
            $stmt2->bindParam(':price', $price);
            $stmt2->bindParam(':enhancement_level', $enhancement_level);
            $stmt2->bindParam(':seller', $seller);
            $stmt2->bindParam(':new_quantity', $new_quantity);
          
            $stmt2->execute();

            
        } catch (Exception $e) {
            // use error_log() function to log the error message
            error_log($e->getMessage(), 0);
            // or use echo to return the error message to your C# script
            echo "0".$e->getMessage();
            exit();
        }
*/



      //  echo "0".$name."`t".$price."`t".$enhancement_level."`t".$seller."`t".$new_quantity."333";

       // $stmt->execute(array(':name' => $name, ':price' => $price, ':enhancement_level' => $enhancement_level, ':seller' => $seller, ':new_quantity' => $new_quantity));
    
        $query2 = "INSERT INTO market_sales (seller, name, price, quantity, level) VALUES (:seller, :name, :price, :quantity, :enhancement_level)";
        $stmt3 = $pdo->prepare($query2);
        $stmt3->execute(array(':seller' => $seller, ':name' => $name, ':price' => $price, ':quantity' => $quantity, ':enhancement_level' => $enhancement_level));
        echo "0";
        exit();
    } else {
        echo "1";
        exit();
    }


    
    echo "5";
    exit();



} else {


    echo "7";
}