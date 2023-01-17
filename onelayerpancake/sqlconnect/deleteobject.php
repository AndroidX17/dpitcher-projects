<?php








if (isset($_POST["id"])) {




    $unity = true;
    $login = true;
    
    $id = $_POST["id"];
    
    require_once '../../keys/storage.php';
    

  
    $sql = 'DELETE FROM `the_builded` WHERE `id`=:id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
 //   $id = $pdo->lastInsertId();
// get login info from query


echo "0";
exit();


} else {

echo "7: uh oh";
exit();

}