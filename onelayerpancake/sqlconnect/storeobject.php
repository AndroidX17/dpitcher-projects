<?php








if (isset($_POST["type"])) {




    $unity = true;
    $login = true;
    
    $type = $_POST["type"];
    $posX = $_POST["posX"];
    $posY = $_POST["posY"];
    $posZ = $_POST["posZ"];
    $rotX = $_POST["rotX"];
    $rotY = $_POST["rotY"];
    $rotZ = $_POST["rotZ"];
    $rotQ = $_POST["rotQ"];
    $hp = $_POST["hp"];
    
    require_once '../../keys/storage.php';
    

  
    $sql = 'INSERT INTO `the_builded` SET `type` = :type, `posX` = :posX, `posY` = :posY, `posZ` = :posZ, `rotX` = :rotX, `rotY` = :rotY, `rotZ` = :rotZ, `rotQ` = :rotQ, `hp` = :hp; SELECT LAST_INSERT_ID();';

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
    $id = $pdo->lastInsertId();
// get login info from query


echo "0\t".$id;
exit();


} else {

echo "7: uh oh";
exit();

}