<?php 









session_start();



require_once '../../keys/storage.php';






if (isset($_SESSION["useruid"])) {


    if (isset($_POST["CHECKMERGE"])) {



        $duplicatesInFirstTable = array();



        $sql4 = "SELECT `address`, COUNT(*)
        FROM `addresses_in_clusters`
        GROUP BY `address`
        HAVING COUNT(*) > 1";
        
        
        
        $result4 = $pdo->query($sql4);
        
        
        
        $counter4 = 0;
        foreach ($result4 as $record4) {
        
        $counter4 = $counter4 + 1;
            array_push($duplicatesInFirstTable, $record4['address']);
        
        
        }
        
        
        
        if ($counter4 === 0) {
        

            header("Location: ../clustermanager.php?error=nomerge"); // go here
            exit();
        
         
        } else {
    

            header("Location: ../clustermanager.php?error=merge"); // go here
            exit();
        }
        











        header("Location: ../clustermanager.php?error=succeed"); // go here
exit();

    } else {




        header("Location: ../clustermanager.php?error=fail"); // go here


        exit();


    }
} else {

    header("Location: ../clustermanager.php?error=nologin"); // go here


    exit();


}







header("Location: ../clustermanager.php?error=none"); // go here








