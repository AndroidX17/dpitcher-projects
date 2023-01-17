<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
 
    <title>  <?php echo $title; ?></title>
    
  <link rel="stylesheet" href="styles.css">
  </head>
  <body>

  <header>
   
  </header>

  <nav>
  <h1>OneLayerPancake</h1>
    <ul>
      <li><a href="https://www.onelayerpancake.com">home</a></li>
      <?php

session_start();



?>

<?php



function getCurrentBitcoinPrice() {

 
$btcprice = "";
$url55 = "https://api.coindesk.com/v1/bpi/currentprice.json";
  
  
$parameters55 = [];



$headers = [
  'Accepts: application/json',
  'Accepts-Encoding: deflate, gzip'
];



$qs55 = http_build_query($parameters55); // query string encode the parameters
$request55 = "{$url55}?{$qs55}"; // create the request URL



$curl55 = curl_init(); // Get cURL resource

curl_setopt_array($curl55, array(
  CURLOPT_URL => $request55,            // set the request URL
  CURLOPT_HTTPHEADER => $headers,     // set the headers 
  CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
));

$response55 = curl_exec($curl55); // Send the request, save the response

$priceinfo = json_decode($response55, true);

$btcprice = $priceinfo['bpi']['USD']['rate'];


return $btcprice;
}


function getCurrentExchangeRateCADUSD() {

 
  $btcprice = "";
  $url55 = "https://api.exchangerate-api.com/v4/latest/USD";
    
    
  $parameters55 = [];
  
  
  
  $headers = [
    'Accepts: application/json',
    'Accepts-Encoding: deflate, gzip'
  ];
  
  /*

  ALTER TABLE table_name
ADD column_name data_type;

*/
  
  $qs55 = http_build_query($parameters55); // query string encode the parameters
  $request55 = "{$url55}?{$qs55}"; // create the request URL
  
  
  
  $curl55 = curl_init(); // Get cURL resource
  
  curl_setopt_array($curl55, array(
    CURLOPT_URL => $request55,            // set the request URL
    CURLOPT_HTTPHEADER => $headers,     // set the headers 
    CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
  ));
  
  $response55 = curl_exec($curl55); // Send the request, save the response
  
  $priceinfo = json_decode($response55, true);
  
  $btcprice = $priceinfo['rates']['CAD'];
  
  
  return $btcprice;
  }
  
  








    if (isset($_SESSION["useruid"])) {

     // echo '<li><a href="database.php">Database test</a></li>';
    //  echo ' <li><a href="default.html">Access test signup form</a></li>';
   echo ' <li><a href="addconcept.php">add to-do</a></li>';
    echo ' <li><a href="viewconcept.php">view to-dos</a></li>';
     // echo ' <li><a href="autophilosopher.php">Autophilosopher</a></li>';
    //  echo ' <li><a href="checkboxes.php">Checkbox test</a></li>';
      echo ' <li><a href="crypto2.php">crypto tx assess</a></li>';
      echo ' <li><a href="bitcoin2.php">crypto wallet assess</a></li>';
      echo ' <li><a href="walletnotes.php">add wallet notes</a></li>';
      echo ' <li><a href="viewnotes.php">view notes</a></li>';
      echo ' <li><a href="clustermanager.php">cluster manager</a></li>';
     // echo ' <li><a href="buddy.php">buddy reports</a></li>';

      echo ' <li><a href="publickeyfinder.php">public key finder</a></li>';

      if ($_SESSION["permissions"] === "NORMAL") {





$sql = 'SELECT `username`,`is_admin` FROM `users_permissions` WHERE `username`="' . $_SESSION["useruid"]. '";';

require_once '../keys/storage.php';



$result = $pdo->query($sql);
$hadpermissions = 0;
  // $sql2 = 'SELECT `concept` FROM `concepts`';
$currentloggedinuser = $_SESSION["useruid"];
$foundmatch = false;
foreach ($result as $row) {
$stuff = $row['username'];
if ($stuff === $currentloggedinuser) {
$foundmatch = true;
$hadpermissions = $row['is_admin'];
}
}

$needaddrelog = false;


if ($hadpermissions === "1" || $hadpermissions === 1) {


  $needaddrelog = true;
} else {

      echo ' <li><a href="requestpermissions.php">request permissions</a></li>';
}
      }

     // echo "<li><a href='profile.php'>Profile</a></li>";


    if ($_SESSION["useruid"] === "admin") {



      $sql = "SELECT * FROM `user_has_request`";

      require_once '../keys/storage.php';

      $query = mysqli_query($conn2, $sql);

      $rowcount=mysqli_num_rows($query);
    

//$result = $conn->query($sql);

//$rows = mysql_result(mysql_query('SELECT COUNT(*) FROM table'), 0);

//if (!$rows) { /* Table is empty */ }

/*
if (mysql_num_rows($result) > 0) { 
  echo "Table is not Empty";
 } else {
  echo "empty";
 }
*/

if ($rowcount === 0) {

  echo "<li><a href='admin.php'>admin</a></li>";
    } else {
      echo "<li><a href='admin.php'>admin (" .   $rowcount . " pending requests) </a></li>";

    }
      
    echo "<li><a href='addbuild.php'>add build</a></li>";
    }







    if ($_SESSION["permissions"] === "SPECIAL") {
echo "<li><a href='playtestportal.php' style='color:yellow'>playtesters</a></li>";
   //   echo "<li><a href='special.php'>Special</a></li>";
      echo "<p class='permissions'>you have permissions</p>";
    } else {
      
   //   echo "<li><a href='special.php'>Special</a></li>";
   echo "<p class='permissions'>you can request permissions</p>";


if ($needaddrelog === true) {
  echo ' <li>your permission request was granted, please relog</li>';
  
}

    }
} else {

  echo "<lI><a href='signup.php'>sign up</A></li>";
  echo "<lI><a href='login.php'>log in</A></li>";

}


if (isset($_SESSION["useruid"])) {
echo "<li><a href='includes/logout.inc.php'>log out</a></li>";
}

?>


  </ul>



<?php








require_once '../keys/storage.php';


$sql6 = 'SELECT `price_timestamp`,`currentprice`,`exchange_rate` FROM `bitcoin_price`';

// $sql2 = 'SELECT `concept` FROM `concepts`';



$resulttimestamp = $pdo->query($sql6);
//$result = $pdo->query($sql2);
$lasttimestamp = "";
$totalrows = $totalrows;
$lastqueriedbtcprice = "";
$lastrate = "";

foreach ($resulttimestamp as $row) {
  $lasttimestamp = $row['price_timestamp'];
  $lastqueriedbtcprice = $row['currentprice'];
  $lastrate = $row['exchange_rate'];
}


if ($lasttimestamp !== "") {


$newstamps = $_SERVER['REQUEST_TIME'];


$stampDIFFFF = $newstamps - $lasttimestamp;

$timebetweenupdates = 60 * 60;
//$timebetweenupdates = 30;






$importantnumber = $timebetweenupdates - $stampDIFFFF;



if ($stampDIFFFF > $timebetweenupdates) {







  $bitcoinpricerightnow = getCurrentBitcoinPrice();
  $lastrate = getCurrentExchangeRateCADUSD();


//ALTER TABLE table_name
//CHANGE old_column_name new_column_name varchar(128);

 // echo " <BR>  you got approve";

 //$sql = 'UPDATE `bitcoin_price` SET `price_timestamp`="'.$newstamps.'" WHERE `id` LIKE "%1%"';//1670475715
 //$sql = 'UPDATE `bitcoin_price` SET `price_timestamp`="'.$newstamps.'", `bitcoin_price`="'.$bitcoinpricerightnow.'" WHERE `id` = "1"';//1670475715
 $sql = 'UPDATE `bitcoin_price` SET `price_timestamp`="'.$newstamps.'", `currentprice`="'.$bitcoinpricerightnow.'", `exchange_rate`="'.$lastrate.'";';//1670475715
//$sql = 'UPDATE `address_helped_cluster` WHERE `address` = "'.$wallet.'" SET `address` = :address, `searched` = :searched';//1670475715


$affectedRows = $pdo->exec($sql);

//dumpitall($currenttx, $pdo);
//echo "<lI><p>".$bitcoinpricerightnow."beef".$importantnumber."ZOO".$newstamps."</p></li>";


$pricenocomma = str_replace(",", "", $bitcoinpricerightnow);
$thebitcoinpriceasfloat = floatval($pricenocomma);
$btcpriceCAD = round(floatval($lastrate) * $thebitcoinpriceasfloat, 0);



echo "<lI><p>Bitcoin price CAD $".$btcpriceCAD."</p></li>";


} else {

  $pricenocomma = str_replace(",", "", $lastqueriedbtcprice);
  $thebitcoinpriceasfloat = floatval($pricenocomma);
  
  $btcpriceCAD = round(floatval($lastrate) * $thebitcoinpriceasfloat, 0);
  

  echo "<lI><p>Bitcoin price CAD $".$btcpriceCAD."</p></li>";

 // echo "<p>wait ".$importantnumber." seconds.</p>";
 // echo "<BR> <p>you got reject</p>";

//if ($buildinputarea === false) {
  //$buildinputarea = true;      
//include  __DIR__ . '/templates/crypto2.html.php';
//}
}



}else {

  // only really happens once
  $bitcoinpricerightnow = getCurrentBitcoinPrice();
  $lastrate = getCurrentExchangeRateCADUSD();
  $stmt5 = $conn->prepare("INSERT INTO bitcoin_price (currentprice, price_timestamp, exchange_rate) VALUES (?, ?, ?)");
    $newstamps = $_SERVER['REQUEST_TIME'];
 $stmt5->bind_param("sss",$newstamps, $bitcoinpricerightnow, $lastrate);
 $stmt5->execute(); 
}




?>




  
  <A HREF="https://www.onelayerpancake.com"><IMG SRC="../OLP2.png" style="float:center;width:208px;height:102px"></A>

  </nav>

  <main>

  <?php echo $output; ?>
  <BR> 

    <BR>

    <?php if (isset($error)): ?>
  <p>
    <?php echo $error; ?>
  </p>

  
  <?php else: ?>
  <?php foreach ($names as $name): ?>
  <blockquote>
    <p>
    <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>
    </p>
  </blockquote>
  <?php endforeach; ?>
  <?php endif; ?>

  <?=$output2?>


  </main>

  <footer>
  &copy; OneLayerPancake 2022

  <BR>
  </footer>
  </body>
</html>