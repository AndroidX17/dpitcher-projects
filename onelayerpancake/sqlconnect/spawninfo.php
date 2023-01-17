<?php








if (isset($_POST["BASICCHECK"])) {


$varvar = $_POST["BASICCHECK"];


    $unity = true;
    
    require_once '../../keys/storage.php';
    



/*
$sql3 = 'SELECT COUNT(*) as total FROM `the_builded`';



$howmanythings = $pdo->query($sql3);
$data=mysql_fetch_assoc($howmanythings);*/

$intthing = intval($varvar);


$intthingminus = $intthing - 1;


//$sql1 = 'SELECT * FROM `the_builded` WHERE rownum = "'.$intthing.'";';
$sql1 = 'SELECT * FROM `the_builded` LIMIT 1 OFFSET '.$intthingminus.';';




$result = $pdo->query($sql1);

$arrayofresults = $result->fetch(); 

//$arrayofresults = $arrayofresults[0];


echo "0\t".$arrayofresults['type']."\t".$arrayofresults['posX']."\t".$arrayofresults['posY']."\t".$arrayofresults['posZ']."\t".$arrayofresults['rotX']."\t".$arrayofresults['rotY']."\t".$arrayofresults['rotZ']."\t".$arrayofresults['rotQ']."\t".$arrayofresults['hp']."\t".$arrayofresults['id'];



exit();


} else {

echo "7: uh oh";
exit();

}