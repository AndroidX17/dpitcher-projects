<?php



if (isset($_POST['eventname'])) {

             

       $eventname = $_POST['eventname'];
       $eventdate = $_POST['eventdate'];
      
        require_once '../../keys/storage.php';

        $sql = 'UPDATE `events` SET `date`="'.$eventdate.'" WHERE `eventname` = "'.$eventname.'";';
      //   $sql = 'UPDATE `address_helped_cluster` WHERE `address` = "'.$wallet.'" SET `address` = :address, `searched` = :searched';//1670475715

        $stmt = $pdo->prepare($sql);
      //  $stmt->bindValue(':address', $wallet);
      //  $stmt->bindValue(':searched', 1);





        $stmt->execute();
      
        $finalstring = "";

        $newarray1 = array();

         /*
   foreach ($results as $resulto) {



    array_push($newarray1, $resulto['eventname']);

}

if (sizeof($newarray1) === 0) {
    header("location: ../guildevent.php?eventname=".$eventname."&error=fail");
    return;
}
*/

header("location: ../guildevent.php?eventname=".$eventname."&error=none");
return;
} else {
    header("location: ../guildevent.php?eventname=".$eventname."&error=nopost");
    return;

}