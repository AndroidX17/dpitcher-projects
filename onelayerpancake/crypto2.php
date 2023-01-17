<?php
session_start();




 
$examplehash = "14c4a9ce346dd91c3b5ccbd4b7ece1adc804f991565fd55668a9834a406a3433";


if (isset($_GET['txid'])) {

  $examplehash = $_GET['txid'];


}



$buildinputarea = false;


function createTimer($importantnumber) {


  // Create the timer HTML

  $timerHTML .= '<div id="timer" style="padding:20px;position:fixed; bottom:0; left:0;">';
  $timerHTML .= '<p>Time remaining: <span id="time">'.$importantnumber.'</span></p>';
  $timerHTML .= '</div>';




  // Print the timer HTML to the web page
  echo $timerHTML;

  // Start the timer countdown
  echo '<script>
          var time = document.getElementById("time");
          var timer = setInterval(function() {
            time.innerHTML = time.innerHTML - 1;
            if (time.innerHTML == 0) {
              clearInterval(timer);
              document.getElementById("timer").innerHTML = "<p>Search permitted</p>";
            }
          }, 1000);
        </script>';


}



function checkWallet($walletgiven, $pdo) {
  $thingtoreturn = "";
  
  /*
  if ($walletgiven === "34xp4vRoCGJym3xR7yCVPFHoCNxv4Twseo") {
  
    $thingtoreturn = "THIS IS BINANCE<BR>";
  }*/
  
  
  
  
  $sql2 = 'SELECT `id`,`wallet`,`note` FROM `new_walletnotes` WHERE `wallet` LIKE "%'.$walletgiven.'%"';
  
  //$sql = 'SELECT `wallet`,`note` FROM `new_walletnotes` WHERE `wallet`="' . $walletgiven. '"';
  
  
  
  
  
  $result = $pdo->query($sql2);
  //$result = $pdo->query($sql2);
  
  
  
  
  $count = 0;
  foreach ($result as $entry) {
  $count = $count + 1;
  
      if ($entry['wallet']) {
  
         // echo "wallet: ".$entry['wallet'];
        //  $appends = $appends."wallet: ".$entry['wallet'];
          }
      //    $appends = $appends."<BR>";
       //   echo "<BR>";
          if ($entry['note']) {
  
            //  echo "note: ".$entry['note'];
              $appends = $appends."".$entry['note'];
              }
              $appends = $appends."<BR><BR>";                    
  
  //echo "<BR>-----------------------<BR><BR><BR>";
  
  }
  
  
  
  return $appends;
  }
  
  



function dumpitall($currenttx, $pdo) {






    
  $txinfo=file_get_contents("https://blockchain.info/rawtx/".$currenttx);

 // echo '<BR>';2816e7a5ce6b21f48fa8a0f6ffe4d6f5e811cf7795cae224614ec50dbc09528b
  
  //echo '<BR>';
  //echo '<DIV style="height:100px;width:200px;background-color:navy;color:white;max-width:500px;border:15px solid white"> <DIV style="padding:20px">TRANSACTION HASH BREAKDOWN </DIV></DIV>';


 // echo '<DIV style="margen: 1rem;padding:30px;">';
 // echo '<DIV style="padding:30px;display:inline-block;background-color:black;color:white;max-width:500px;border:15px solid navy">';
 // echo '<CENTER><H5>WALLETS THAT PAY</H5></CENTER>';

$leftsidedata = array();
$rightsidedata = array();


$thirdsidedataL = array();
$thirdsidedataR = array();

  $txinfoarray=array();
  if($txinfo)
  {
  
    $txinfo=json_decode($txinfo,true);


    if($txinfo && isset($txinfo['inputs']) && $txinfo['inputs'])
    {
      $txns=$txinfo['inputs'];
      foreach($txns as $txn)// we are looking at the array of all of the addresses on the left side of mempool
       {

        $prevout = $txn['prev_out'];



       // print_r($prevout);

       // echo "<BR>asdad+++++++++++++";
        
        $addrr = $prevout['addr'];

$walletinfoL = checkWallet($addrr, $pdo);


if ($walletinfoL !== "") {



 array_push($thirdsidedataL, $walletinfoL);
  
}


        $values = $prevout['value'];
        $satoshis=100000000;
     //   print_r("ADDRESS: ".$addrr);
      //  echo "<BR>";

        $valuesbtc = $values/$satoshis;

     //   print_r("VALUE: ".$valuesbtc."btc");

        $leftsidestring = $addrr." for ".$valuesbtc." btc";
  array_push($leftsidedata, $leftsidestring);


//echo "<BR>";
//echo "----------------------------------";

//echo "<BR>";

       }
      }


     // echo "</DIV>";

   //   echo '<DIV style="display:inline-block;background-color:black;color:white;max-width:500px;border:5px solid navy;">';
    //  echo '<CENTER><H5>WALLETS THAT RECEIVE</H5></CENTER>';

      
    if($txinfo && isset($txinfo['out']) && $txinfo['out'])
    {
      $txns=$txinfo['out'];




      foreach($txns as $txn)
       {

$transactionstring = "";
$realamount2 = -1;

        if ($txn['value']) {

          $satoshizz=100000000;
          $realamount = $txn['value'];
$realamount2 = $realamount / $satoshizz;



       //   echo "value received is: ".$realamount2;
       //   echo "<BR>";
        
        
          }
//print_r($txn);
//echo "<BR>";



if ($txn) {
if ($txn['addr']) {


//echo "outgoing address : ".$txn['addr'];
//echo "<BR>";


$walletinfoR = checkWallet($txn['addr'], $pdo);


if ($walletinfoR !== "") {



 array_push($thirdsidedataR, $walletinfoR);
  
}

$transactionstring = $transactionstring.$txn['addr']." for ".$realamount2." btc ";
array_push($rightsidedata, $transactionstring);
}

foreach($txn as $tx)// we are looking at the array of a particular address on the right side of mempool
{
// print_r($tx);
// echo "<BR>";


}
}


//echo "</DIV>";
//echo "</DIV>";



     // $amount=$txn[0];
     //    $time=$txn['time'];
     //    $hash=$txn['hash'];
     //    $transaction_list[]=array(
     //      'amount'=>$amount,
       //    'hash'=>$hash,
        //   'time'=>$time
      //   );

       }
      }



    }




    $data['hash']=$txinfo['hash'];
    $data['time']=$txinfo['time'];
//    $data['total_txn']=$txnlist['n_tx'];
//    $data['total_received']=$txnlist['total_received']/$satoshi;
//    $data['total_sent']=$txnlist['total_sent']/$satoshi;
//    $data['final_balance']=$txnlist['final_balance']/$satoshi;
//    $data['transaction_list']=$transaction_list;



$newtime = date('m/d/Y',  $data['time']);


//echo "<BR>";
//echo "<BR>";




//print_r($txinfo);




  //  echo "<BR> search was made for tx - ";

    //echo $currenttx;
    





    if ($buildinputarea === false) {
      $buildinputarea = true;     

      if (isset($_GET["txid"])) {

      } else {
      ob_start();
      include __DIR__ . '/templates/crypto2.html.php';
      $output = ob_get_clean();
    }
    
   //   include  __DIR__ . '/templates/crypto2.html.php';
      
      }

echo '<div class="container3">';



echo '        <table class="table1">';
echo '              <thead>';

echo '                 <tr>';
echo '                   <th>TX ID</th>';
echo '                    <th>'.$currenttx.'</th>';
echo '                    <th>Notes/Flags</th>';
echo '                 </tr>';


echo "  <tr>";
echo " <td>Date</td>";
echo " <td>".$newtime."</td>";
echo " <td></td>";

echo "  </tr>";



$sizeofleftsidedata = sizeof($leftsidedata);
$sizeofrightsidedata = sizeof($rightsidedata);

$sizeofthirdsideLdata = sizeof($thirdsidedataL);
$sizeofthirdsideRdata = sizeof($thirdsidedataR);

$thebiggerofthetwo = 0;

if ($sizeofleftsidedata > $sizeofrightsidedata) {
  $thebiggerofthetwo = $sizeofleftsidedata;
} else {


  $thebiggerofthetwo = $sizeofrightsidedata;
}


for ($x=0;$x<$thebiggerofthetwo;$x++) { // this is how many rows we are going to do

  $textcolor1 = "white";
  $textcolor2 = "white";
  $textcolor3 = "white";

  $firstcolumndata = "";
  $secondcolumndata = "";
  $thirdcolumndata = "";

  $specialcolor = "#bdd6ff";

  if ($x < $sizeofleftsidedata) {
  $firstcolumndata=$leftsidedata[$x];
  }
  if ($x < $sizeofrightsidedata) {
  $secondcolumndata=$rightsidedata[$x];
  }
 
  if ($x < $sizeofthirdsideLdata) {
    $thirdcolumndata=$thirdsidedataL[$x];
    }
   
  if ($x < $sizeofthirdsideRdata) {
    $thirdcolumndata=$thirdcolumndata.$thirdsidedataR[$x];
    }
   
  

echo "  <tr>";
  echo " <td style='color:".$textcolor1.";'>".$firstcolumndata."</td>";
  echo " <td style='color:".$textcolor2.";'>".$secondcolumndata."</td>";
  echo " <td style='color:".$textcolor3.";'>".$thirdcolumndata."</td>";

  echo "  </tr>";



}





  echo '             </tbody>';
  echo '         </table>';
  echo '         </div>';


  
}









if (isset($_SESSION["useruid"])) {

  if ($_SESSION["permissions"] === "SPECIAL") {

    if (isset($_POST["cryptotx"])) {

    } else {


      if (isset($_GET["cryptotx"])) {



      } else {

        if (isset($_GET["txid"])) {


        } else {
        if ($buildinputarea === false) {
      include  __DIR__ . '/templates/crypto2.html.php';
   
      $buildinputarea =true;
        }


    }
  }

    }



   // include  __DIR__ . '/templates/coinmarketcheck.html.php';


   if (isset($_POST["cryptotx"]) || isset($_GET["txid"])) {


$currenttx = "";

if (isset($_POST["cryptotx"])) {

  $currenttx = $_POST["cryptotx"];
}

if (isset($_GET["txid"])) {

  $currenttx = $_GET["txid"];
}


   // $currenttx = $_POST["cryptotx"];
    
    if ($currenttx === "") {
    
        
    
    
    
    

    
    
    
        echo "you cannot search a nothing";
    
    } else {
    













  
      require_once '../keys/storage.php';



      $sql5 = 'SELECT `lastrequest` FROM `last_timestamp_tx`';
      
      // $sql2 = 'SELECT `concept` FROM `concepts`';
      
      
      
      $result = $pdo->query($sql5);
      //$result = $pdo->query($sql2);
      $lasttimestamp = "";
      $totalrows = $totalrows;
      
      foreach ($result as $row) {
        $lasttimestamp = $row['lastrequest'];
      }
      
      if ($lasttimestamp !== "") {
      
      echo "FOUND TIME STAMP";
      
      $newstamps = $_SERVER['REQUEST_TIME'];
      
      
      $stampDIFFFF = $newstamps - $lasttimestamp;
      $importantnumber = 20 - $stampDIFFFF;
      

      


 
      if ($stampDIFFFF > 20) {
      
        echo " <BR>  you got approve";
      
      $sql = 'UPDATE `last_timestamp_tx` SET `lastrequest`="'.$newstamps.'" WHERE `id` LIKE "%1%"';//1670475715
      
      
      $affectedRows = $pdo->exec($sql);
      
            
      createTimer(20);



dumpitall($currenttx, $pdo);


      } else {
      

        echo "<p>wait ".$importantnumber." seconds.</p>";
        echo "<BR> <p>you got reject</p>";
        if ($importantnumber === 0) {
          $importantnumber = 1;
        }
        createTimer($importantnumber);

if ($buildinputarea === false) {
        $buildinputarea = true;      
include  __DIR__ . '/templates/crypto2.html.php';
}
      }
      
      
      
     // echo "<BR> we executed code to affect something to ".$affectedRows;
      
      
   //   echo " WAAA";
      
      } else {
      
        // only really happens once
  //    echo "WE DUMP BIG";
dumpitall($currenttx, $pdo);
        $stmt5 = $conn->prepare("INSERT INTO last_timestamp_tx (lastrequest) VALUES (?)");
          $newstamps = $_SERVER['REQUEST_TIME'];
       $stmt5->bind_param("s",$newstamps);
       $stmt5->execute(); 
        // $stmt->bind_param("s",$concepttext);
         // $stmt->execute(); 
      
      //echo " <BR> ".$newstamps;
      
        //echo " QUERIED BUT NO STIME TSMPA so we add entry";
      }
























    }
  }

if (isset($_POST["cryptowallet"])) {



$currentwallet = $_POST["cryptowallet"];

if ($currentwallet === "") {

    








    echo "you cannot search a nothing";

} else {


    echo "<BR> search was made for ";

    echo $currentwallet;
    



 
   // $bcinfo = json_decode(file_get_contents("https://blockchain.info/address/".$currentwallet."?format=json"), true);
    
  //  $balance = $bcinfo["total_received"];


 //   echo $balance;

   echo "<BR>";
    
  //  echo 'Address Balance: ' . getBalance($currentwallet);

//$newbalance = getBalance($currentwallet);

//$newbalance2 = $newbalance / 100000000;

//echo 'Address Balance: ' . $newbalance . ' btc ';


// Address Balance: 37699570

//echo '<BR>';


//$receivedby = getReceivedBy($currentwallet);

//$receivedby2 = $receivedby / 100000000;

//echo 'Address receives: ' . $receivedby  . ' btc ';


//echo '<BR>';


//$sentby = getSentBy($currentwallet);

//$sentby = $sentby / 100000000;

//echo 'Address sends: ' . $sentby  . ' btc ';



echo '<BR>';


//$firstseen = addressFirstSeen($currentwallet);


//echo 'first seen: '.date('m/d/Y',  $firstseen);




//curl -s https://blockchain.info/tx/25ecdc29903aa8f80efb51a6b41ac036a91fe441aefd0d26df383827b9578cae\?format\=json | jq '.inputs[0]."prev_out".addr'
/*
$morewalletinfo=file_get_contents("https://blockchain.info/balance?active=".$address);


echo '<BR>';

echo '<BR>';

echo '<BR>';
$morewalletinfo_list=array();
if($morewalletinfo)
{

  $morewalletinfo=json_decode($morewalletinfo,true);
 print_r($morewalletinfo);


}


echo '<BR>';

echo '<BR>';

echo '<BR>';




*/






$address = $currentwallet;







/*

$newbalanceinfo=file_get_contents("https://blockchain.info/balance?active=".$address);



if($newbalanceinfo)
{
  $newbalanceinfo2=json_decode($newbalanceinfo,true);

foreach($newbalanceinfo2 as $newbalanceinfo2i)
//$newamountin = $newbalanceinfo2['n_tx'];

if ($newbalanceinfo2i['n_tx']) {
print_r("this many tx in: ".$newbalanceinfo2i['n_tx']);
}


}


*/
















echo "<BR>";
echo "<BR>";
echo "<BR>";



echo "<BR>eee";
    

echo $address;
$transaction_list2=array();
$satoshi=100000000;
//$txnlist2=getrawaddress($currentwallet); //https://blockchain.info/rawaddr/1EzwoHtiXB4iFwedPr49iywjZn2nnekhoj
// / return file_get_contents('https://blockchain.info/q/getsentbyaddress/'. $address);

//$stuffss = file_get_contents('https://blockchain.info/rawaddr/1EzwoHtiXB4iFwedPr49iywjZn2nnekhoj1EzwoHtiXB4iFwedPr49iywjZn2nnekhoj');
//$stuffsss=json_decode($stuffss,true);
//echo $stuffsss;
/*

if($txnlist2)
{
  $txnlist2=json_decode($txnlist2,true);
  if($txnlist2 && isset($txnlist2['txs']) && $txnlist2['txs'])
  {
    $txns2=$txnlist2['txs'];
    foreach($txns2 as $txn2)
     {
       $amount=$txn2['result']/$satoshi;
       $time=$txn2['time'];
       $hash=$txn2['hash'];
       $transaction_list[]=array(
         'amount'=>$amount,
         'hash'=>$hash,
         'time'=>$time
       );
     }
    }
 $data['address']=$txnlist2['address'];
 $data['total_txn']=$txnlist2['n_tx'];
 $data['total_received']=$txnlist2['total_received']/$satoshi;
 $data['total_sent']=$txnlist2['total_sent']/$satoshi;
 $data['final_balance']=$txnlist2['final_balance']/$satoshi;
 $data['transaction_list']=$transaction_list2;
} else {

  echo "no data";
}
print '<pre>';
print_r($data);
print '</pre>';

if ($data['total_txn'] > 100) {

/*
echo '<FORM action="" method="post">';
echo '<input type="hidden" name="address" value="'. $txnlist2['address'] . '">';
echo '<INPUT type="submit" value="next 100">';
echo '</FORM>';

  
}
*/


echo "End";



   // die();


//echo '<BR>';


//$nextblock = nextBlock();


//echo 'next block ETA :' . $nextblock;





























}






    
    }








$output = ob_get_clean();
  } else {

    $output = "you dont have permission to add";
  }





} else {
  $output = "not logged in";
}

   include __DIR__ . '/templates/layout.html.php';


   function getReceivedBy($address) {
  //  return file_get_contents('https://blockchain.info/q/getreceivedbyaddress/'. $address);
  return "feature disabled";
}
function getSentBy($address) {
 // return file_get_contents('https://blockchain.info/q/getsentbyaddress/'. $address);
  return "feature disabled";
}
function getBalance($address) {
 //return file_get_contents('https://blockchain.info/q/addressbalance/'. $address);
 return "feature disabled";
}
function addressFirstSeen($address) {
 return file_get_contents('https://blockchain.info/q/addressfirstseen/'. $address);
}

function getrawaddress($address) {
  return file_get_contents('https://blockchain.info/q/rawaddr/'. $address);
 }
//function nextBlock() {
 // return file_get_contents('https://blockchain.info/q/interval/');
// }
  // include __DIR__ . '/templates/formresults.html.php';
   ?>






<?php
//$url = 'https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
//$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/map';
//$url2 = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';

// https://pro-api.coinmarketcap.com
/*
$parameters = [
  'start' => '1',
  'limit' => '5000',
 // 'convert' => 'USD'
];
*/

/*
$parameters2 = [
  'start' => '1',
  'limit' => '100',
 // 'convert' => 'USD'
];

require_once '../keys/storage.php';



$headers = [
  'Accepts: application/json',
  'Accepts-Encoding: deflate, gzip',
  'X-CMC_PRO_API_KEY: ' . $CMC
];
//$qs = http_build_query($parameters); // query string encode the parameters

$qs2 = http_build_query($parameters2); // query string encode the parameters
////$request = "{$url}?{$qs}"; // create the request URL

$request2 = "{$url2}?{$qs2}"; // create the request URL



$curl2 = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl2, array(
  CURLOPT_URL => $request2,            // set the request URL
  CURLOPT_HTTPHEADER => $headers,     // set the headers 
  CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
));



/*
$curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl, array(
  CURLOPT_URL => $request,            // set the request URL
  CURLOPT_HTTPHEADER => $headers,     // set the headers 
  CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
));*/
/*
//$response = curl_exec($curl); // Send the request, save the response
$response2 = curl_exec($curl2); // Send the request, save the response

//$decode = json_decode($response);
$decode2 = json_decode($response2);
//$info = $decode->status->timestamp;

//$coindata = $decode->data;

//$bitcoinprice = $coindata[0]->name;

//print_r($info);


//print_r("<BR>");
//print_r($bitcoinprice);

//print_r("<BR>");
$coindata2 = $decode2->data;

//$newvar = $coindata2[0]->id;
//$newvar2 = $coindata2[0]->name;
//$newvar3 = $coindata2[0]->symbol;
//$newvar4 = $coindata2[0]->slug;
//$newvar5 = $coindata2[0]->num_market_pairs;
$newvar6 = $coindata2[0]->quote->USD->price;

print_r("<BR>btc price: ");
print_r($newvar6);*/

/*
print_r("<BR>");
print_r($newvar);
print_r("<BR>");
print_r($newvar2);
print_r("<BR>");
print_r($newvar3);
print_r("<BR>");
print_r($newvar4);
print_r("<BR>");
print_r($newvar5);
print_r("<BR>");
print_r("<BR>");
print_r($coindata2);

print_r("<BR>");
*/
//print_r(json_decode($response2)); // print json decoded response






//curl_close($curl); // Close request
?>











<style type='text/css'>

html,
body {
	<? echo $maxheight ?>
}

</STYLE>