<?php


           // if (isset($_POST["eventNAME"])) {
           //     $eventID = $_POST["eventID"];
           $inputJSON = file_get_contents("php://input");
           $input = json_decode($inputJSON, true);
         
//$results = array_values($input);

       //   var_dump($input);

       /*
       if ($input['id'] == "78912" || $input['id'] == 78912) {
        echo "7";
        return;
       }*/

       if ($input['id'] != 78912 ) { 

        echo "9";
        return;
       }


             

       $eventname = $input['eventname'];
     //  $eventdate = $input['eventdate'];
      
        require_once '../../keys/storage.php';

        $sql = 'SELECT * FROM `events` WHERE `eventname` = "'.$eventname.'";';
        $results = $pdo -> query($sql);
    
      
        $finalstring = "";

        $newarray1 = array();

        
foreach ($results as $resulto) {



    array_push($newarray1, $resulto['eventname']);

}

if (sizeof($newarray1) === 0) {
    echo "8";
    return;
}




    $sql = 'UPDATE `events` SET `maxplayers`=3 WHERE `eventname` = "'.$eventname.'";';//1670475715


    $affectedRows = $pdo->exec($sql);

    if ($affectedRows === 0) {

        echo "6";
        return;
    }
    echo "3";
    exit();


   // header("location: ../admin.php?error=successdelete");
   echo "0";
    exit();




