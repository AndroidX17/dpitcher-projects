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


             




      
       require_once '../../keys/storage.php';



       $eventname = $input['eventname'];


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






$sql = 'DELETE FROM `events` WHERE `eventname` = "'.$eventname.'";';
$stmt = $pdo -> prepare($sql);
$stmt->execute();


    echo "0";
    exit();



