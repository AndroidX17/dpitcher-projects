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

           if ($input['eventname']) { 

/*
                $eventNAME = $_POST["eventNAME"];
                $eventDATE = $_POST["eventDATE"];
                $maxplayer = $_POST["maxplayer"];
                $player1 = "";
                $player2 = "";
                $player3 = "";
                $player4 = "";
                $player5 = "";*/
                
             
                $eventname = $input['eventname'];
                $eventdate = $input['eventdate'];
                $maxplayers = $input['maxplayers'];
                $player1 = $input['player1'];
                $player2 = $input['player2'];
                $player3 = $input['player3'];
                $player4 = $input['player4'];
                $player5 = $input['player5'];


                /*
                if ($maxplayer == "3"){
                    $player1 = $_POST["eventPLAYER1"];
                    $player2 = $_POST["eventPLAYER2"];
                    $player3 = $_POST["eventPLAYER3"];
    
                }
                if ($maxplayer == "5" || $maxplayer == 5){
                $player1 = $_POST["eventPLAYER1"];
                $player2 = $_POST["eventPLAYER2"];
                $player3 = $_POST["eventPLAYER3"];
                $player4 = $_POST["eventPLAYER4"];
                $player5 = $_POST["eventPLAYER5"];

            }
*/

      
        require_once '../../keys/storage.php';

        $sql = 'INSERT INTO `events` set `eventname` = :eventname, `date` = :eventdate,  `maxplayers` = :maxplayers,  `player1` = :player1,  `player2` = :player2,  `player3` = :player3,  `player4` = :player4,  `player5` = :player5;';
        $stmt = $pdo -> prepare($sql);
        $stmt->bindValue(':eventname', $eventname);
        $stmt->bindValue(':eventdate', $eventdate);
        $stmt->bindValue(':maxplayers', $maxplayers);
        $stmt->bindValue(':player1', $player1);
        $stmt->bindValue(':player2', $player2);
        $stmt->bindValue(':player3', $player3);
        $stmt->bindValue(':player4', $player4);
        $stmt->bindValue(':player5', $player5);
        $stmt->execute();
        
        
   // header("location: ../admin.php?error=successdelete");
   echo "0";
    exit();



     
        } else {
            echo "1";
            exit();
        
        }




        echo "2";
        exit();
    




