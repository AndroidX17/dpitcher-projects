<?php








if (isset($_POST["item_name"])) {




    $unity = true;
    $login = true;
    
    $itemname = $_POST["item_name"];
    
    require_once '../../keys/storage.php';
    

  
    $sql = 'INSERT INTO `item` SET `item_name` = :item_name';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':item_name', $itemname);
    $stmt->execute();


    header("Location: ../admin.php?error=none"); // go here
    exit();
echo "0";
exit();


} else {

echo "7: uh oh";
exit();

}