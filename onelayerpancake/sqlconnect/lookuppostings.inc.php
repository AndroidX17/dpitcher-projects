<?php


if (isset($_POST["code"])) {


    $unity = true;
    $login = true;
    
$username = $_POST["playername"];
    
    require_once '../../keys/storage.php';
    
    $statement = $pdo->prepare("SELECT `name`, MIN(`price`) as `cheapest_price`, SUM(`quantity`) as `total_quantity` FROM `market_items` WHERE `seller` != :playerName GROUP BY `name`");
    $statement->bindParam(':playerName', $username);

   // $statement = $pdo->prepare("SELECT name, MIN(`price`) as `cheapest_price`, SUM(`quantity`) as `total_quantity` FROM `market_items` GROUP BY name");
    $statement->execute();
    $results = $statement->fetchAll();
    
  

$totalstring = "";
    foreach($results as $row) {
        $totalstring = $totalstring.$row['name'] . ":" . $row['cheapest_price'] . ":" . $row['total_quantity'] . ";";
    }

    echo "0".$totalstring;
   // echo "0".$totalstring;

exit();


} else {


    echo "7".$_POST["code"];
}