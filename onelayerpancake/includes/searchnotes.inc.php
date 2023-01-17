<?php 




session_start();
$search = "";

if (isset($_SESSION["useruid"])) {

    if ($_SESSION["permissions"] === "SPECIAL") {
  

if (isset($_POST["notesearch"])) {


    if ($_POST["notesearch"]) {


        

        $search = $_POST["notesearch"];


        if ($search === "") {

            

        header("location: ../viewnotes.php?error=empty");



        exit();

        }

        require_once '../../keys/storage.php';
    $sql2 = 'SELECT `id`,`wallet`,`note` FROM `new_walletnotes` WHERE (`wallet` LIKE "%'.$search.'%" OR `note` LIKE "%'.$search.'%")';

    
        
     $result = $pdo->query($sql2);
        //$result = $pdo->query($sql2);
        
        $appends = "";
       $count = 0;
        foreach ($result as $entry) {
$count = $count + 1;

            if ($entry['wallet']) {

               // echo "wallet: ".$entry['wallet'];
                $appends = $appends."wallet: ".$entry['wallet'];
                }
                $appends = $appends."<BR>";
             //   echo "<BR>";
                if ($entry['note']) {

                  //  echo "note: ".$entry['note'];
                    $appends = $appends."note: ".$entry['note'];
                    }
                    $appends = $appends."<BR>-----------------------<BR><BR><BR>";                    

//echo "<BR>-----------------------<BR><BR><BR>";

        }


           // echo "end";
            $appends = $appends."end";                    

   if ($count === 0) {
    
    header("location: ../viewnotes.php?error=nomatch");



    exit();

   }
echo $appends;
        header("location: ../viewnotes.php?error=succeed");



        exit();










    } else {
        
        header("location: ../viewnotes.php?error=error7");
        exit();
    }
} else {
    
    header("location: ../viewnotes.php?error=error6");
    exit();
}
    } else {



        header("location: ../viewnotes.php?error=error5");

        exit();
    }



} else {

header("location: ../viewnotes.php?error=notloggedin");



exit();

}

header("location: ../viewnotes.php?error=alldone");
