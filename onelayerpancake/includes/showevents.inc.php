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

        $sql = 'SELECT `eventname`,`date` FROM `events`';
        $results = $pdo -> query($sql);
    
        $finalstring = "";

        $newarray1 = array();
        $newarray2 = array();
foreach ($results as $resulto) {


    array_push($newarray1, $resulto['eventname']);
    array_push($newarray2, $resulto['date']);


}

for ($x=0;$x<sizeof($newarray1);$x++) {

    $finalstring = $finalstring."`t".$newarray1[$x]." date ".$newarray2[$x];

}
    
   // header("location: ../admin.php?error=successdelete");
   echo "0".$finalstring;
    exit();




