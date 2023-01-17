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
       $playername = $input['playername'];
      
        require_once '../../keys/storage.php';

        $sql = 'SELECT * FROM `events` WHERE `eventname` = "'.$eventname.'";';
        $results = $pdo -> query($sql);
    
      
        $finalstring = "";

        $newarray1 = array();

        
        $arraymaxplayers = array();
        $arrayplayer1 = array();
        $arrayplayer2 = array();
        $arrayplayer3 = array();
        $arrayplayer4 = array();
        $arrayplayer5 = array();

        $firstplayer = "";
        $secondplayer = "";
        $thirdplayer = "";
        $fourthplayer = "";
        $fifthplayer = "";
        $maxplayers = "";
        $eventid = 0;
foreach ($results as $resulto) {
$eventid = $resulto['id'];
    $firstplayer = $resulto['player1'];
    $secondplayer = $resulto['player2'];
    $thirdplayer = $resulto['player3'];
    $fourthplayer = $resulto['player4'];
    $fifthplayer = $resulto['player5'];
    $maxplayers = $resulto['maxplayers'];
 


    array_push($newarray1, $resulto['eventname']);
    array_push($arraymaxplayers, $resulto['maxplayers']);
    array_push($arrayplayer1, $resulto['player1']);
    array_push($arrayplayer2, $resulto['player2']);
    array_push($arrayplayer3, $resulto['player3']);
    array_push($arrayplayer4, $resulto['player4']);
    array_push($arrayplayer5, $resulto['player5']);


}

$playeralreadyhere = 0;

if ($firstplayer == $playername) {
    $playeralreadyhere= 1;
}

if ($secondplayer == $playername) {
    $playeralreadyhere= 1;
}

if ($thirdplayer == $playername) {
    $playeralreadyhere= 1;
}

if ($fourthplayer == $playername) {
    $playeralreadyhere= 1;
}

if ($fifthplayer == $playername) { 
    $playeralreadyhere= 1;
}


if ($playeralreadyhere === 0) {


    echo "T";
    return;

}

if (sizeof($newarray1) === 0) {
    echo "8";
    return;
}



$sql = 'UPDATE `events` SET `player1`="unknown" WHERE `eventname` = "'.$eventname.'" AND `player1` = "'.$playername.'";UPDATE `events` SET `player2`="unknown" WHERE `eventname` = "'.$eventname.'" AND `player2` = "'.$playername.'";UPDATE `events` SET `player3`="unknown" WHERE `eventname` = "'.$eventname.'" AND `player3` = "'.$playername.'";UPDATE `events` SET `player4`="unknown"WHERE `eventname` = "'.$eventname.'" AND `player4` = "'.$playername.'";UPDATE `events` SET `player5`="unknown"WHERE `eventname` = "'.$eventname.'" AND `player5` = "'.$playername.'";';//1670475715


$affectedRows = $pdo->exec($sql);
/*
if ($affectedRows === 0) {

    echo "3";
    return;
}*/


   // header("location: ../admin.php?error=successdelete");
   echo "0";
    exit();




