<?php
session_start();




ob_start();

 

if (isset($_SESSION["useruid"])) {

  if ($_SESSION["permissions"] === "SPECIAL") {

    include  __DIR__ . '/templates/crypto.html.php';


   // include  __DIR__ . '/templates/coinmarketcheck.html.php';


   if (isset($_POST["cryptotx"])) {



    $currenttx = $_POST["cryptotx"];
    
    if ($currenttx === "") {
    
        
    
    
    
    

    
    
    
        echo "you cannot search a nothing";
    
    } else {
    





    
      $txinfo=file_get_contents("https://blockchain.info/rawtx/".$currenttx);

      echo '<BR>';
      
      echo '<BR>';
      echo '<DIV style="height:100px;width:200px;background-color:navy;color:white;max-width:500px;border:15px solid white"> <DIV style="padding:20px">TRANSACTION HASH BREAKDOWN </DIV></DIV>';
   
  
      echo '<DIV style="margen: 1rem;padding:30px;">';
      echo '<DIV style="padding:30px;display:inline-block;background-color:black;color:white;max-width:500px;border:15px solid navy">';
      echo '<CENTER><H5>WALLETS THAT PAY</H5></CENTER>';
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

            $values = $prevout['value'];
            $satoshis=100000000;
            print_r("ADDRESS: ".$addrr);
            echo "<BR>";

            $valuesbtc = $values/$satoshis;

            print_r("VALUE: ".$valuesbtc."btc");

      


echo "<BR>";
echo "----------------------------------";

echo "<BR>";

           }
          }


          echo "</DIV>";

          echo '<DIV style="display:inline-block;background-color:black;color:white;max-width:500px;border:5px solid navy;">';
          echo '<CENTER><H5>WALLETS THAT RECEIVE</H5></CENTER>';

          
        if($txinfo && isset($txinfo['out']) && $txinfo['out'])
        {
          $txns=$txinfo['out'];


  

          foreach($txns as $txn)
           {
            if ($txn['value']) {

              $satoshizz=100000000;
              $realamount = $txn['value'];
$realamount2 = $realamount / $satoshizz;
              echo "value received is: ".$realamount2;
              echo "<BR>";
            
            
              }
 //print_r($txn);
 //echo "<BR>";



if ($txn) {
  if ($txn['addr']) {


  echo "outgoing address : ".$txn['addr'];
  echo "<BR>";


  }

  foreach($txn as $tx)// we are looking at the array of a particular address on the right side of mempool
  {
// print_r($tx);
// echo "<BR>";


  }
}


echo "</DIV>";
echo "</DIV>";



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

   print_r($newtime);

   echo "<BR>";
   echo "<BR>";




 //print_r($txinfo);




    
        echo "<BR> search was made for tx - ";
    
        echo $currenttx;
        

        

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


$firstseen = addressFirstSeen($currentwallet);


echo 'first seen: '.date('m/d/Y',  $firstseen);




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
$txnlist2=file_get_contents('https://blockchain.info/rawaddr/'. $currentwallet);
// / return file_get_contents('https://blockchain.info/q/getsentbyaddress/'. $address);
/*
if($txnlist2)
{
  $txnlist2=json_decode($txnlist2,true);
  if($txnlist2 && isset($txnlist2['txs']) && $txnlist2['txs'])
  {
    $txns=$txnlist2['txs'];
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
//function nextBlock() {
 // return file_get_contents('https://blockchain.info/q/interval/');
// }
  // include __DIR__ . '/templates/formresults.html.php';
   ?>






<?php
//$url = 'https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
//$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/map';
$url2 = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';

// https://pro-api.coinmarketcap.com
/*
$parameters = [
  'start' => '1',
  'limit' => '5000',
 // 'convert' => 'USD'
];
*/
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
print_r($newvar6);

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






curl_close($curl); // Close request
?>










