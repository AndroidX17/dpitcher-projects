<?php

session_start();

require_once '../../keys/storage.php';


if (isset($_SESSION["useruid"])) {

    $firstanswers = array();
    $secondanswers = array();

    $totalcode = "BUDDY REPORT<BR>";
    $totalcode = $totalcode."-------------<BR><BR>";


$totalchecked = 0;

    $totalcode = $totalcode."First Boxes:<BR><BR>";

    for ($x=1;$x <= 20; $x++) {
        $check1 = $_POST["FIRSTFLAG".$x];
    
    
    
       // require_once 'dbh.inc.php';
       // require_once 'functions.inc.php';
    
    if ($check1 === "on") {
    
        $totalchecked = $totalchecked + 1;
    
    $totalcode = $totalcode."-initial box ".$x." checked<BR>";
    

   array_push($firstanswers, 1);
    
    } else {
    
    
        //$totalcode = $totalcode."-first box unchecked";
    
   array_push($firstanswers, 0);
    
    //header("location: ../checkboxes.php?error=recordedfalse");
    //exit();
    }
    
    
    
    
        }



        $totalcode = $totalcode."<BR>";


    $totalcode = $totalcode."Secondary Boxes:<BR><BR>";
    for ($x=1;$x <= 20; $x++) {
    $check1 = $_POST["BUDDYFLAG".$x];



   // require_once 'dbh.inc.php';
   // require_once 'functions.inc.php';

if ($check1 === "on") {


    $totalchecked = $totalchecked + 1;

$totalcode = $totalcode."-box ".$x." checked<BR>";


array_push($secondanswers, 1);
} else {


    array_push($secondanswers, 0);
    //$totalcode = $totalcode."-first box unchecked";


//header("location: ../checkboxes.php?error=recordedfalse");
//exit();
}




    }

    $totalcode = $totalcode."<BR>-------------";

    
    $totalcode = $totalcode."<BR>";
    $totalcode = $totalcode."<BR>";
    $totalcode = $totalcode."<BR>DECISION: ".$_POST["STFFF"];


    if ($totalchecked === 0) {

        $totalcode = "no checkboxes were checked";
        
        }
        



        $stmt = $conn->prepare("INSERT INTO buddy_report (firstbox1, firstbox2, firstbox3, firstbox4, firstbox5, firstbox6, firstbox7, firstbox8, firstbox9, firstbox10, firstbox11, firstbox12, firstbox13, firstbox14, firstbox15, firstbox16, firstbox17, firstbox18, firstbox19, firstbox20, buddybox1, buddybox2, buddybox3, buddybox4, buddybox5, buddybox6, buddybox7, buddybox8, buddybox9, buddybox10, buddybox11, buddybox12, buddybox13, buddybox14, buddybox15, buddybox16, buddybox17, buddybox18, buddybox19, buddybox20, decision)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    
        $stmt->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiis", $firstanswers[0],  $firstanswers[1],  $firstanswers[2],  $firstanswers[3],  $firstanswers[4],  $firstanswers[5],  $firstanswers[6],  $firstanswers[7],  $firstanswers[8], $firstanswers[9],  $firstanswers[10],  $firstanswers[11],  $firstanswers[12], $firstanswers[13], $firstanswers[14], $firstanswers[15], $firstanswers[16], $firstanswers[17], $firstanswers[18], $firstanswers[19], $secondanswers[0], $secondanswers[1], $secondanswers[2], $secondanswers[3], $secondanswers[4], $secondanswers[5], $secondanswers[6], $secondanswers[7], $secondanswers[8], $secondanswers[9],$secondanswers[10],$secondanswers[11],$secondanswers[12],$secondanswers[13],$secondanswers[14],$secondanswers[15],$secondanswers[16],$secondanswers[17],$secondanswers[18],$secondanswers[19],$_POST['STFFF']);
        $stmt->execute();
    $stmt->store_result();
   





    echo $totalcode;
} else {

    $totalcode = $totalcode."<BR>NO LOG IN";
    

echo $totalcode;
}

















