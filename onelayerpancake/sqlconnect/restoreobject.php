<?php








if (isset($_POST["BASICCHECK"])) {





    $unity = true;
    $login = true;
    
    
    require_once '../../keys/storage.php';
    
/*
$sql3 = 'SELECT COUNT(*) as total FROM `the_builded`';



$howmanythings = $pdo->query($sql3);
$data=mysql_fetch_assoc($howmanythings);*/

$sql1 = 'SELECT * FROM `the_builded`';

$result = $pdo->query($sql1);

$totals = 0;

foreach ($result as $resulto) {

    $totals += 1;
}


echo "0\t".$totals;
exit();


} else {

echo "7: uh oh";
exit();

}