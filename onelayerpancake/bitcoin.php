<?php
session_start();


$askedformore = 0;
$nextpage = 0;
$lasthash = "";

function dumpeverything($wallet, $lastoffset, $lasthash) {

  
  require_once '../keys/storage.php';
  
  
  $lastknowntxid = "";
  
  
  $url3 = "https://mempool.space/api/address/".$wallet;
  
  
  $parameters3 = [];
  
  
  
  
  $headers = [
    'Accepts: application/json',
    'Accepts-Encoding: deflate, gzip'
  ];
  
  
  
  $qs3 = http_build_query($parameters3); // query string encode the parameters
  $request3 = "{$url3}?{$qs3}"; // create the request URL
  
  
  
  $curl3 = curl_init(); // Get cURL resource
  
  curl_setopt_array($curl3, array(
    CURLOPT_URL => $request3,            // set the request URL
    CURLOPT_HTTPHEADER => $headers,     // set the headers 
    CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
  ));
  
  $response3 = curl_exec($curl3); // Send the request, save the response
  
  $walletinfo = json_decode($response3, true);
  
  echo "<BR>";
  echo "<BR>";
  echo "<BR>";
  echo "<BR>";
  echo "<BR>";
  echo "<BR>";
  echo "<BR>";
  echo "<BR>";
  echo "<BR>";
  $chainstats = $walletinfo['chain_stats'];
  
  echo "WALLET CHECK SUCCEED";
  echo "<BR>";
  echo "<BR>";
  echo $walletinfo['address'];
  echo "<BR>";
  echo "<BR>";
  echo "<DIV style='width:500px;background-color:navy;color:white;font-size:15px;'>";
  
  $satoshiiii = 100000000;
  $num1 = $chainstats['spent_txo_sum'];
  $moneysent = $num1 / $satoshiiii;
  
  $num3 = $chainstats['funded_txo_sum'];
  $moneygained = $num3 / $satoshiiii;
  
  
  echo "Wallet received: ";
  echo $chainstats['funded_txo_count'];
  echo " btc <BR>";
  echo "</DIV>";
  
  echo "Incoming tx count: ";
  echo $moneygained;
  echo "<BR>";
  echo "</DIV>";
  
  echo "spent_txo_count: ";
  echo $chainstats['spent_txo_count'];
  echo "<BR>";
  echo "</DIV>";
  
  echo "Wallet sent: ";
  echo $moneysent;
  echo " btc <BR>";
  
  echo "Outgoing tx count: ";
  echo $chainstats['tx_count'];
  echo "<BR>";
  $balances = $moneygained - $moneysent;
  echo "Balance: ";
  echo $balances;
  echo "<BR>";
  
  
  $newinfoaboutwallet = checkWallet($wallet);
  
  echo $newinfoaboutwallet;
  
  
  if ($chainstats['tx_count'] > 25) {
  
  
    echo "<BR> there are more than 25 transactions. you will need to load more to see them all."; // - 0.00112662
  }
  
  echo "</DIV>";
  
  
  $offset = $lastoffset;
  
  
   
  

    $offset = $offset + 25;
  
  
  
  $append = "";
  if ($lasthash !== "") {
$append = $lasthash;

  }
  
  $url2 = "https://mempool.space/api/address/".$wallet."/txs/chain/".$append; // chain?last_seen_txid=25 ... ????
  $parameters2 = [];
  
  
  
  $bonushtml = "";
  
  $qs2 = http_build_query($parameters2); // query string encode the parameters
  $request2 = "{$url2}?{$qs2}"; // create the request URL
  
  $curl2 = curl_init(); // Get cURL resource
  
  curl_setopt_array($curl2, array(
    CURLOPT_URL => $request2,            // set the request URL
    CURLOPT_HTTPHEADER => $headers,     // set the headers 
    CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
  ));
  
  $response2 = curl_exec($curl2); // Send the request, save the response
  
  $txinfo = json_decode($response2, true);
  
  
  $transactioncount = 0;
  
  $totalgained = 0;
  $totalsent = 0;
  
  //echo " YOU LOOKED UP THIS WALLET: ".$wallet."<BR>";
  echo "<BR>";
  foreach($txinfo as $txn)// we are looking at the array of all of the addresses on the left side of mempool
  {
  
  
  $amountaffected = 0;
  $direction = 0;
  
  
    echo "<DIV >";
  echo "<DIV style='display:inline-block;height:450px;width:400px;background-color:blue;color:white;'>";
    
  $lastknowntxid = $txn['txid'];
  print_r($txn['txid']);
  $transactioncount = $transactioncount + 1;
 
  //echo "transaction #".$transactioncount.": ".$txn['txid']."<BR>";
  
  
  
  
  
  echo "<BR>--------------------";
  
  
  
  
  $status = $txn['status'];
  
  $timestamp = $status['block_time'];
  
  echo "The date of transaction: ".date(DATE_RFC2822,  $timestamp); // m/d/Y
  //echo "The date of transaction: ".date('l jS \of F Y h:i:s A',  $timestamp); // m/d/Y
  
  
  
  echo "<BR>--------------------";
  
  
  
  if($txn && isset($txn['vin']) && $txn['vin'])
  {
    $incomingthings=$txn['vin'];
  
    $totalleftside = sizeof($incomingthings);
  
    if ($totalleftside > 5) {
  
      echo "many entries (".$totalleftside."), will only show 5...<BR>";
    }
   $bonushtmlleftside = "";
  $totalshownleftside = 0;
  
    foreach($incomingthings as $incomingthing) {
  
  
      if($incomingthing && isset($incomingthing['prevout']) && $incomingthing['prevout'])
      {
        $prevoutness=$incomingthing['prevout'];
      
   $ouraddress = $prevoutness['scriptpubkey_address'];
  
  
  $theamount = $prevoutness['value'];
  
  $totalshownleftside = $totalshownleftside + 1;
     $satoshii=100000000;
     $realamount = $theamount / $satoshii;
  
     if ($ouraddress === $wallet) {
  
      $totalgained = $totalgained + $realamount;
  $amountaffected = $amountaffected + $realamount;
  
  if ($direction === 0) {
    $direction = 1;
  }
  if ($direction === 2) {
  
    $direction = 3;
  }
  
      echo "<DIV style='color:red'>";
      $bonushtmlleftside = $bonushtmlleftside."<DIV style='color:red'>";
    }
    
    if ($totalshownleftside < 5 || $ouraddress === $wallet) {
  
  
  
        echo "the address is: ".$ouraddress." for ".$realamount." BTC";
        echo "<BR>";
        $bonushtmlleftside = $bonushtmlleftside."the address is: ".$ouraddress." for ".$realamount." BTC<BR>";
      } 
      if ($totalshownleftside < 5) {
  
  
      } else {
        $bonushtmlleftside = $bonushtmlleftside."the address is: ".$ouraddress." for ".$realamount." BTC<BR>";
      }
  
  
        if ($ouraddress === $wallet) {
  
          $bonushtmlleftside = $bonushtmlleftside."</DIV>";
          echo "</DIV>";
        }
  
       
      }
  //echo " <BR> ";
  //echo " Incoming address: ".$incomingthing['txid']."<BR>";
  
    }
  
  
  
  
  
  
  
    if ($totalshownleftside < 5) {
  
  
    } else {
    
      $bonushtmlleftside = '"'.$bonushtmlleftside.'"';
  
    echo "<BR>";
      echo "<INPUT TYPE='hidden' name='LEFTSIDEINFO".$transactioncount."'  id='LEFTSIDEINFO".$transactioncount."' value=$bonushtmlleftside>";
      echo "<INPUT TYPE='button' onclick='writeLEFTSIDEiNFO".$transactioncount."()' value='display all'>";
  echo "<BR>";  
  
        echo "<script>
    
  
  function writeLEFTSIDEiNFO".$transactioncount."() {
  
  var stufftowrite = document.getElementById('LEFTSIDEINFO".$transactioncount."').value;
  document.write(stufftowrite);
  
  }
  
        </script>";
      
  
    }
  
  
  
  
  }
  
  
  
  echo "</DIV>";
  
  
  echo "<DIV style='display:inline-block;height:450px;width:500px;background-color:navy;color:white;'>";
  
  echo " goes to here<BR>";
  if($txn && isset($txn['vout']) && $txn['vout'])
  {
    $incomingthings=$txn['vout'];
   $totalentries = sizeof($incomingthings);
  
   if ($totalentries > 5) {
  
  echo "<BR> there are a lot of addresses (".$totalentries.") so we'll show only first 5...<BR>";
  
  
   }
  
  $totalshown = 0;
  $bonushtml = "";
    foreach($incomingthings as $incomingthing) {
  
      
      $totalshown = $totalshown + 1;
  
  
  $theamount2 = $incomingthing['value'];
  
  
  $satoshiii=100000000;
  $realamount2 = $theamount2 / $satoshiii;
     //echo "the address is: ".$ouraddress." for ".$realamount." BTC";
     //echo "<BR>";
  
  
     if ($incomingthing['scriptpubkey_address'] === $wallet) {
  
      echo "<DIV style='color:red'>";
      $totalsent = $totalsent + $realamount2;
  
      $bonushtml =$bonushtml."<DIV style='color:red'>";
      $amountaffected = $amountaffected - $realamount2;
  
      if ($direction === 0) {
        $direction = 2;
      }
      if ($direction === 1) {
      
        $direction = 3;
      }
  
    }
    
    if ($incomingthing['scriptpubkey_address'] === $wallet || $totalshown < 5) {
      echo "<BR>";
      
      $bonushtml =$bonushtml."<BR>the address going to is : ".$incomingthing['scriptpubkey_address']." for ".$realamount2." BTC<BR>";
   echo "the address going to is : ".$incomingthing['scriptpubkey_address']." for ".$realamount2." BTC";
   echo "<BR>";
    } 
    
    if ($totalshown < 5)
    {
      
    
    } else {
      $bonushtml =$bonushtml."<BR>the address going to is : ".$incomingthing['scriptpubkey_address']." for ".$realamount2." BTC<BR>";
    }
  
  
      if ($incomingthing['scriptpubkey_address'] === $wallet) {
  
        $bonushtml =$bonushtml."</DIV>";
        echo "</DIV>";
      }
      
  
  /*
      if($incomingthing && isset($incomingthing['prevout']) && $incomingthing['prevout'])
      {
        $prevoutness=$incomingthing['prevout'];
      
   $ouraddress = $prevoutness['scriptpubkey_address'];
  
  $theamount = $prevoutness['value'];
  
  
     $satoshii=100000000;
     $realamount = $theamount / $satoshii;
        echo "the address is: ".$ouraddress." for ".$realamount." BTC";
        echo "<BR>";
  
      }
  //echo " <BR> ";
  //echo " Incoming address: ".$incomingthing['txid']."<BR>";
  */
  
  
  
    
  
  
  
  
  
  
  
  
  
  
    }
  
    if ($totalshown > 5) {
  
      $bonushtml = '"'.$bonushtml.'"';
  
    echo "<BR>";
      echo "<INPUT TYPE='hidden' name='INFO".$transactioncount."'  id='INFO".$transactioncount."' value=$bonushtml>";
      echo "<INPUT TYPE='button' onclick='writeiNFO".$transactioncount."()' value='display all'>";
  echo "<BR>";  
  
        echo "<script>
    
  
  function writeiNFO".$transactioncount."() {
  
  var stufftowrite = document.getElementById('INFO".$transactioncount."').value;
  document.write(stufftowrite);
  
  }
  
        </script>";
      
  
  
       }
    
  
  }
  
  
  echo "<DIV style='display:inline-block;height:350px;width:200px;background-color:white;color:navy;'>";
    
  echo " AMOUNT CHANGE ".$amountaffected."<BR>";
  
  $newdirection = "";
  
  if ($direction === 0) {
    $newdirection = "unknown";
  }
  if ($direction === 1) {
    $newdirection = "sent";
  }
  if ($direction === 2) {
    $newdirection = "gained";
  }
  if ($direction === 3) {
    $newdirection = "special";
  }
  
  echo " DIRECTION WOULD BE ".$newdirection;
  
  echo "</DIV>";
  
  
  echo "</DIV>";
  
  
  
  
  
  
  echo "</DIV>";













  
  }

  
  
  echo "<FORM method='post' action=''";
  echo "<BR> <INPUT type='hidden' value='".$wallet."' id='postwallet' name='postwallet'>";
  echo "<BR> <INPUT type='hidden' value='".$wallet."' id='cryptowallet' name='cryptowallet'>";
  echo "<BR> <INPUT type='hidden' value='1' id='nextpage' name='nextpage'>";
  echo "<BR> <INPUT type='hidden' value='1' id='givemore' name='givemore'>";
  echo "<BR> <INPUT type='hidden' value='".$lastknowntxid."' id='lasthash' name='lasthash'>";
  echo "lastknown hash: ".$lastknowntxid;
  echo "<BR>showing transactions from the beginning plus this page offset: <INPUT type='text' value='".$offset."' id='postoffset' name='postoffset'>"; // 34xp4vRoCGJym3xR7yCVPFHoCNxv4Twseo
  
  if ($chainstats['tx_count'] > 25) {
  
  echo "<BR><INPUT type='submit' value='load another 25' name='moretxsubmit' id='moretxsubmit'>";
  
  
  
  
  }
  echo "</FORM>";



  // this section successfully gets some transaction info
  
  $offbyX = $totalgained - 150.07599040;
  $offbyY = $totalsent - 150.07650586;
  
  echo "<BR>";
  echo "<BR>";
  echo "<BR>";
  echo "<BR>TOTAL GAINED:".$totalgained."(SHOULD BE 150.07599040) off by ".$offbyX;
  echo "<BR>TOTAL SENT:".$totalsent."(SHOULD BE 150.07650586) off by".$offbyY;
  
  
  
  $currentbalance = $totalsent - $totalgained;
  
  echo "<BR> BALANCE: ".$currentbalance."(SHOULD BE 0.00051546)";
  
  
  
  } // end of function
  
  


ob_start();

 
include __DIR__ . '/templates/layout.html.php';







function checkWallet($walletgiven) {
$thingtoreturn = "";
if ($walletgiven === "34xp4vRoCGJym3xR7yCVPFHoCNxv4Twseo") {

  $thingtoreturn = "THIS IS BINANCE<BR>";
}

return $thingtoreturn;
}




$lastoffset = 1;

if (isset($_POST["postoffset"]) && $_POST["postoffset"]) {
$lastoffset = $_POST['postoffset'];

}

if (isset($_POST["cryptowallet"])) {

  if (isset($_POST["lasthash"]) && $_POST["lasthash"]) {
 

if (isset($_POST["givemore"]) && $_POST["givemore"]) {
 
  $nextpage = 1;

  $wallet = $_POST["cryptowallet"];
  



  
require_once '../keys/storage.php';



$sql5 = 'SELECT `lastrequest` FROM `last_timestamp`';

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

echo "<BR> it been".$stampDIFFFF." seconds.";

if ($stampDIFFFF > 20) {

  echo " <BR>  you got approve";

$sql = 'UPDATE `last_timestamp` SET `lastrequest`="'.$newstamps.'" WHERE `id` LIKE "%1%"';//1670475715


$affectedRows = $pdo->exec($sql);


dumpeverything($wallet, $lastoffset, $_POST["lasthash"]);
} else {

  echo "<BR> you got reject";
}



echo "<BR> we executed code to affect something to ".$affectedRows;


echo " WAAA";

} else {

  // only really happens once

  $stmt5 = $conn->prepare("INSERT INTO last_timestamp (lastrequest) VALUES (?)");
    $newstamps = $_SERVER['REQUEST_TIME'];
 $stmt5->bind_param("s",$newstamps);
 $stmt5->execute(); 
  // $stmt->bind_param("s",$concepttext);
   // $stmt->execute(); 

   dumpeverything($wallet, $lastoffset, $_POST["lasthash"]);
//echo " <BR> ".$newstamps;

  //echo " QUERIED BUT NO STIME TSMPA so we add entry";
}


  
  } else {

  }

}else {

}

}
if (isset($_POST["cryptowallet"])) {



    $wallet = $_POST["cryptowallet"];
    
    if ($wallet === "") {
    
        
    } else {



/*

      $txnlist=file_get_contents("https://mempool.space/api/address/".$wallet."/txs");


      if($txnlist)
      {
      //  $txnlist=json_decode($txnlist,true);

print_r($txnlist);
      }
*/

/*
        $address = $wallet;

        $transaction_list=array();
        $satoshi=100000000;
        $txnlist=file_get_contents("https://blockchain.info/rawaddr/".$address);
        if($txnlist)
        {
          $txnlist=json_decode($txnlist,true);
          if($txnlist && isset($txnlist['txs']) && $txnlist['txs'])
          {
            $txns=$txnlist['txs'];
            foreach($txns as $txn)
             {
               $amount=$txn['result']/$satoshi;
               $time=$txn['time'];
               $hash=$txn['hash'];
               $transaction_list[]=array(
                 'amount'=>$amount,
                 'hash'=>$hash,
                 'time'=>$time
               );
             }
            }
         $data['address']=$txnlist['address'];
         $data['total_txn']=$txnlist['n_tx'];
         $data['total_received']=$txnlist['total_received']/$satoshi;
         $data['total_sent']=$txnlist['total_sent']/$satoshi;
         $data['final_balance']=$txnlist['final_balance']/$satoshi;
         $data['transaction_list']=$transaction_list;
        }
        print '<pre>';
        print_r($data);
        die();*/


// https://pro-api.coinmarketcap.com
/*
$parameters = [
  'start' => '1',
  'limit' => '5000',
 // 'convert' => 'USD'
];
*/


require_once '../keys/storage.php';



$sql5 = 'SELECT `lastrequest` FROM `last_timestamp`';

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

echo "<BR> it been".$stampDIFFFF." seconds.";

if ($stampDIFFFF > 20) {

  echo " <BR>  you got approve";

$sql = 'UPDATE `last_timestamp` SET `lastrequest`="'.$newstamps.'" WHERE `id` LIKE "%1%"';//1670475715


$affectedRows = $pdo->exec($sql);

dumpeverything($wallet, $lastoffset, "");
} else {

  echo "<BR> you got reject";
}



echo "<BR> we executed code to affect something to ".$affectedRows;


echo " WAAA";

} else {

  // only really happens once

  $stmt5 = $conn->prepare("INSERT INTO last_timestamp (lastrequest) VALUES (?)");
    $newstamps = $_SERVER['REQUEST_TIME'];
 $stmt5->bind_param("s",$newstamps);
 $stmt5->execute(); 
  // $stmt->bind_param("s",$concepttext);
   // $stmt->execute(); 

//echo " <BR> ".$newstamps;

  //echo " QUERIED BUT NO STIME TSMPA so we add entry";
}

/*
require_once '../keys/storage.php';
//echo $concepttext;
//console.log("test");
     // $stmt = $conn->prepare("INSERT INTO concepts (concept) VALUES (?)");
    
    // $stmt->bind_param("s",$concepttext);
     // $stmt->execute(); 


        $sql = 'INSERT INTO `concepts` SET `concept` = :concepttext';
    // $sql = 'INSERT INTO concepts (concept) VALUES (?)';

  $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':concepttext', $concepttext);
    $stmt->execute();
*/


//



/*
if($txinfo2 && isset($txinfo2['txid']) && $txinfo2['txid'])
{
  $txns=$txinfo2['txid'];
  foreach($txns as $txn)// we are looking at the array of all of the addresses on the left side of mempool
   {

  //  $prevout = $txn['prev_out'];



   // print_r($prevout);

   // echo "<BR>asdad+++++++++++++";
    
  //  $addrr = $prevout['addr'];

   // $values = $prevout['value'];
  //  $satoshis=100000000;
    print_r("ADDRESS: ".$txn);
    echo "<BR>";




echo "<BR>";
echo "----------------------------------";

echo "<BR>";

   }
  }*/
//$coindata = $decode->data;
/*

        $curl_response = curl_exec($txnlist);

        function escapeJsonString($value) { 
            $escapers = array("\'");
            $replacements = array("\\/");
            $result = str_replace($escapers, $replacements, $value);
            return $result;
        }
        
        
        
        $curl_response = escapeJsonString($curl_response);
        
        $curl_response = json_decode($curl_response,true);
        
        echo '<pre>';print_r($curl_response);
        
        echo $error = json_last_error();*/

$amountReceived  = "150BTC";
$amountReceived = $totalgained;
$amountSent = "150BTC";
$amountSent = $totalsent;





if (isset($_SESSION["useruid"])) {

  if ($_SESSION["permissions"] === "SPECIAL") {

    include  __DIR__ . '/templates/bitcoindata.html.php';

  }
}









    }




}

if (isset($_SESSION["useruid"])) {

  if ($_SESSION["permissions"] === "SPECIAL") {

    include  __DIR__ . '/templates/bitcoin.html.php';

  }
}


if (isset($_POST['postwallet'])) {

  echo "<SCRIPT language='javascript'>
  

  document.getElementById('cryptowallet').value = '".$_POST['postwallet']."';
  
  
  </SCRIPT>";

}

