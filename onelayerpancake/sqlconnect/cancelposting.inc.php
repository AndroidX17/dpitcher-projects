<?php


if (isset($_POST["code"])) {


    $unity = true;
    $login = true;
    

    require_once '../../keys/storage.php';
    



    if ($conn->connect_error) {
        echo "Error connecting to the database.";
        die();
    }



    $saleID = $_POST["saleID"];
    $playerName = $_POST["username"];



   // Check if the player name is the same as the item seller name
$sql = "SELECT `seller`,`quantity` FROM `market_items` WHERE id=:saleid";

   $statement = $pdo->prepare($sql);
   $statement->bindParam(':saleid', $saleID);

  // $statement = $pdo->prepare("SELECT name, MIN(`price`) as `cheapest_price`, SUM(`quantity`) as `total_quantity` FROM `market_items` GROUP BY name");
   $statement->execute();



   $results = $statement->fetch();

    $sellername = $results['seller'];



 


    $salequantity = $results['quantity'];
 
  //  echo "0"."///". $salequantity . "///" . $sellername;
 //   exit();

   /*
   $qery1 = "SELECT seller FROM market_items WHERE id='$saleID'";
   $sellerNameresults = $pdo->query($qery1);
$sellaname = "";
foreach ($sellerNameresults as $sellerNameresult) {

$sellaname = $sellerNameresult['seller'];
}
*/


   if ($sellername != $playerName) {
       echo "3".$sellername."///".$playerName."///".$saleID;
       exit();
   }
 //  $getQuantity = "SELECT quantity FROM market_items WHERE id='$saleID'";
  // $quantity = mysqli_query($conn, $getQuantity);
   // Delete the entry from the database
   $delete = "DELETE FROM market_items WHERE id='$saleID'";
   $result = mysqli_query($conn, $delete);

   if ($result) {
       echo "0".$salequantity;
   } else {
       echo "1";
   }

   mysqli_close($conn);








    
exit();


    } else {
        echo "2";
        exit();
    }







