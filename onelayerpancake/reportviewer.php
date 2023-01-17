<?php
require_once '../keys/storage.php';
$title = 'OneLayerPancake';
session_start();
ob_start();






//$sql3 = 'SELECT COUNT(*) FROM `buddy_report`';

// $result = mysql_query("SELECT COUNT(*) FROM Students;");


//$buddyreports = $pdo->query($sql3);

// maybe a better version has time stamps on the reports and who submitted them

$sql = "SELECT * FROM `buddy_report`";


$query = mysqli_query($conn2, $sql);

$buddyreports=mysqli_num_rows($query);

echo "TOTAL <A HREF='buddy.php'>BUDDY REPORTS: </A>";
echo $buddyreports;
echo "<BR>";
//echo " STUFF".$buddyreports;


$totalfirstbox1 = 0;
foreach ($query as $entry) {
if ($entry['firstbox1'] === "1") {
$totalfirstbox1 = $totalfirstbox1 + 1;
}
}
$percentfirst = $totalfirstbox1/$buddyreports;
$percentfirst = $percentfirst * 100;
echo "percent that checked first box was " . round($percentfirst, 2)."%";




$sql2 = 'SELECT `id`,`concept` FROM `concepts`';

// $sql2 = 'SELECT `concept` FROM `concepts`';



$concepts = $pdo->query($sql2);


include  __DIR__ . '/templates/reportviewer.html.php';




$output = ob_get_clean();

include  __DIR__ . '/templates/layout.html.php';

?>

