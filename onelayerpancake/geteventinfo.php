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
    
        require_once '../keys/storage.php';

        $sql = 'SELECT * FROM `events` WHERE `eventname` = "'.$eventname.'";';

         
        $results = $pdo -> query($sql);
   
     
        $finalstring = "";

        $newarray1 = array();

        $maxplayers = "";
        $eventdate = "";
        $player1 = "";
        $player2 = "";
        $player3 = "";
        $player4 = "";
        $player5 = "";

        
foreach ($results as $resulto) {



    array_push($newarray1, $resulto['eventname']);
    $maxplayers = $resulto['maxplayers'];
    $eventdate = $resulto['date'];
    $player1 = $resulto['player1'];
    $player2 = $resulto['player2'];
    $player3 = $resulto['player3'];
    $player4 = $resulto['player4'];
    $player5 = $resulto['player5'];
}





if (sizeof($newarray1) === 0) {
    echo "8";
    return;
}


$finalstring = $finalstring."`t".$maxplayers."`t".$eventdate."`t".$player1."`t".$player2."`t".$player3."`t".$player4."`t".$player5;


    echo "3".$finalstring;
    exit();


   // header("location: ../admin.php?error=successdelete");
   echo "0";
    exit();




