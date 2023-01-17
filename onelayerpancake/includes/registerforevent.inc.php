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
foreach ($results as $resulto) {

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


if ($playeralreadyhere === 1) {


    echo "T";
    return;

}

if (sizeof($newarray1) === 0) {
    echo "8";
    return;
}

$maxplayervalue = $arraymaxplayers[0];
$totalinevent = 0;

$firstslotfree = 0;
$secondslotfree = 0;
$thirdslotfree = 0;
$fourthslotfree = 0;
$fifthslotfree = 0;



if ($firstplayer == "unknown") {
  
    $firstslotfree = 1;
    } else {
        $totalinevent = $totalinevent + 1;
    }

    if ($secondplayer == "unknown") {
        $secondslotfree = 1;
    } else {
        $totalinevent = $totalinevent + 1;
    
    }

    if ($thirdplayer == "unknown") {
        $thirdslotfree = 1;
    } else {
        $totalinevent = $totalinevent + 1;
        
    }

    if ($fourthplayer == "unknown") {

    $fourthslotfree = 1;
    } else {
        $totalinevent = $totalinevent + 1;
    }

    if ($fifthplayer == "unknown") {

    $fifthslotfree = 1;
    } else {
        $totalinevent = $totalinevent + 1;
    }




if ($totalinevent === intval($maxplayers)) {

    echo "7";
    exit();


}

if ($firstslotfree === 1) {



    $sql = 'UPDATE `events` SET `player1`="'.$playername.'" WHERE `eventname` = "'.$eventname.'";';//1670475715


    $affectedRows = $pdo->exec($sql);

    if ($affectedRows === 0) {

        echo "6";
        return;
    }
    echo "3";
    exit();

}
if ($secondslotfree === 1) {



    $sql = 'UPDATE `events` SET `player2`="'.$playername.'" WHERE `eventname` = "'.$eventname.'";';//1670475715


    $affectedRows = $pdo->exec($sql);

    if ($affectedRows === 0) {
        echo "6";
        return;
    }
    echo "5";
    exit();
}

if ($thirdslotfree === 1) {



    $sql = 'UPDATE `events` SET `player3`="'.$playername.'" WHERE `eventname` = "'.$eventname.'";';//1670475715


    $affectedRows = $pdo->exec($sql);

    if ($affectedRows === 0) {
        echo "6";
        return;
    }
    echo "1";
    exit();
}

if ($fourthslotfree === 1) {



    $sql = 'UPDATE `events` SET `player4`="'.$playername.'" WHERE `eventname` = "'.$eventname.'";';//1670475715


    $affectedRows = $pdo->exec($sql);

    if ($affectedRows === 0) {
        echo "6";
        return;
    }
    echo "4";
    exit();
}

if ($fifthslotfree === 1) {



    $sql = 'UPDATE `events` SET `player5`="'.$playername.'" WHERE `eventname` = "'.$eventname.'";';//1670475715


    $affectedRows = $pdo->exec($sql);

    if ($affectedRows === 0) {
        echo "6";
        return;
    }
    echo "2";
    exit();
}


   // header("location: ../admin.php?error=successdelete");
   echo "0";
    exit();




