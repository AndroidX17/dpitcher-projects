<?php
    session_start();
    if (isset($_SESSION["useruid"])) { 
    } else {
        header('Location: cubiedex.php');
        exit();
    }
?>

<style> 
        main img {
            display: block; 
            float: center;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 0.5em;
            height: 100px;
            width: 100px;
            cursor: pointer;
        }

        table, th {
            border: 0px;
            text-align: center;
            color: #555;
        }

        tr {
            display:flex; 
            flex-wrap: wrap;
        }

        td {
            border:0px;
            text-align: center;
            color: #555;
            width: 140px;
        }

        td:hover {
            background-color: #A7D3F8;
        }
        
        td.checked {
            background-color:#A7ECF8;
        }
        td.checked:hover {
            background-color: #A7D3F8;
        }

        table td.form-cell:hover{
            background-color: #FFFFFF;
        }

        caption {
            font-size: 20px;
            font-weight: bold;
            text-align: left;
            color: #555;
        }

        .regular-checkbox {
    	    -webkit-appearance: none;
	        background-color: #fafafa;
	        border: 1px solid #cacece;
	       /* box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05); */
	        padding: 9px;
	        border-radius: 3px;
	        display: inline-block;
	        position: relative;
        }

        .regular-checkbox:active, .regular-checkbox:checked:active {
	       /* box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1); */
        }

        .regular-checkbox:checked {
	        background-color: #3BDBF6;
	        border: 1px solid #adb8c0;
	        /*box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1); */
	        /*color: #1982F4; */
        }

        .regular-checkbox:checked:after {
            /*content: '\2714';
        	font-size: 14px;
	        position: absolute;
	        top: 0px;
        	left: 3px; */
	        color: #3BDBF6;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position:fixed;
            top: 50%; 
            left: 50%;
            transform: translate(-50%, -50%);
            border: 3px solid #f1f1f1;
            z-index: 8;
        }

        /* Add styles to the form container */
        .form-container {
            width: 320px;
            padding: 10px;
            background-color: white;
            margin-bottom: 0; 
        }

        /* Full-width input fields */
        .form-container input[type=text], .form-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus, .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom:10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, {
            opacity: 1;
        }
</style>




<?php

$arrayofcubies = array();

    if (isset($_SESSION["useruid"])) {


        $cubie = true;
        require_once '../keys/storage.php';

        $sql = 'SELECT * FROM `has_cubie` WHERE `usersUid` = "'.$_SESSION["useruid"].'"';
        
        $result = $pdoCUBIE->query($sql);

        $arrayofcubies = $result->fetch(); 

        $arrayofcubiesHAS = array();
        $arrayofcubiesBOUGHT = array();
        $arrayofcubiesPRINT = array();
     
        for ($x=2;$x<146;$x++) {

            $cubiesubdata = preg_split("/\s*,\s*/", $arrayofcubies[$x]);

            array_push($arrayofcubiesHAS, $cubiesubdata[0]);
            array_push($arrayofcubiesBOUGHT, $cubiesubdata[1]);
            array_push($arrayofcubiesPRINT, $cubiesubdata[2]);
        }

    }
?>



<script>  


        function bgChange(checkbox){
            var td = checkbox.parentNode;
            if (checkbox.checked) {
                td.classList.add('checked');
            } else {
                td.classList.remove('checked'); 
            }
        }

        function closeALL() {

            var allterms = ["blue", "green", "yellow", "red", "purple", "white", "og", "bitcoin", "pirate_captain", "ethereum", "shark", "ice", "pizza", "summer", "snoozy", "boba", "ronda", "patches", "jett", "tiger_lily", "softy", "holly", "missy", "iki", "kuki", "kauka", "wawae", "ino", "ka_pu", "enemi", "haohao", "hihiu", "niho", "olioli", "makeneki", "kopaa", "moo", "anu", "pohaku", "hamau", "metala", "kaka", "paipika", "hookahi", "luna", "kaulana", "koa", "nani", "pila", "kelepona", "ox", "qipao", "fire_dragon", "tiger", "yellow_dragon", "hula", "surf", "chill", "sneaky_seal", "turtle", "canada", "usa", "uk", "bitcoin_beach", "pumpkin", "monster", "mummy", "vampire", "witch", "black_cat", "zombie", "skeleton", "ghost_laura", "ghost_george", "santa", "rudolph", "snowman", "elf", "gingerbread", "taylor", "lily", "skipper", "jacob", "nutcracker", "turkey", "nye_2021", "valentine", "leprechaun", "thanksgiving", "nye_2022", "air", "water", "earth", "fire", "sushi_chef", "master_sushi_chef", "construction", "foreman", "rng", "tiki_chief", "architect", "marshaller", "jamie", "natalie", "angela", "laura", "george", "wombat", "doge", "veriblock", "suku", "pat_morita", "ecuador_football", "argentina_football", "australia_football", "iran_football", "france_football", "saudi_arabia_football", "qatar_football", "cameroon_football", "brazil_football", "switzerland_football", "denmark_football", "england_football", "netherlands_football", "poland_footbal", "united_states_football", "wales_football", "costa_rica_football", "japan_football", "canada_football", "senegal_football", "mexico_football", "tunisia_football", "south_korea_football", "germany_football", "uruguay_football", "croatia_football", "belgium_football", "spain_football", "serbia_football", "portugal_football", "morocco_football", "ghana_football", "scorpio", "sagittarius"];


            for (x=0;x<allterms.length;x++) {

                var currentterm = "form-" + allterms[x];

                var formDIV = document.getElementById(currentterm);

                if (formDIV) {

                    formDIV.style.display = "none";

                }

            }

        }


        function openForm(formId, mainOwnedCheck, popOwnedCheck, formImg, img) {

            closeALL();

            // Get the values of the checkboxes
            var originalOwnedCheck = document.getElementById(mainOwnedCheck);
            var formOwnedCheck = document.getElementById(popOwnedCheck);

            // Add an event listener to listen for changes to the checkbox on the original page
            document.getElementById(mainOwnedCheck).addEventListener('change', function() {

                // Set the value of the checkbox in the form based on the value of the checkbox on the original page
                formOwnedCheck.checked = originalOwnedCheck.checked;
                });

            formOwnedCheck.checked = originalOwnedCheck.checked;
            document.getElementById(formImg).src = img.getAttribute("data-img");
            document.getElementById(formId).style.display = "block";
        }

        function closeForm(formId) {
            document.getElementById(formId).style.display = "none";
        }

        function updateOriginal(checkMain, checkPop) {
            // Get the values of the checkboxes
            var originalCheck = document.getElementById(checkMain);
            var formCheck = document.getElementById(checkPop);

            // Set the value of the checkbox on the original page based on the value of the checkbox in the form
            originalCheck.checked = formCheck.checked;

        }

    /*    function clickImageOnCellClick(imageId, cellId) {
            // Get a reference to the image element
            const imageElement = document.getElementById(imageId);

            // Get a reference to the cell element
            const cellElement = document.getElementById(cellId);

            // Add a click event listener to the cell element
            cellElement.addEventListener('click', function() {
                // When the cell is clicked, trigger a click event on the image element
                imageElement.click();
                });
        } */

</script>




<?php


$newarray = array("blue", "green", "yellow", "red", "purple", "white", "og", "bitcoin", "pirate_captain", "ethereum", "shark", "ice", "pizza", "summer", "snoozy", "boba", "ronda", "patches", "jett", "tiger_lily", "softy", "holly", "missy", "iki", "kuki", "kauka", "wawae", "ino", "ka_pu", "enemi", "haohao", "hihiu", "niho", "olioli", "makeneki", "kopaa", "moo", "anu", "pohaku", "hamau", "metala", "kaka", "paipika", "hookahi", "luna", "kaulana", "koa", "nani", "pila", "kelepona", "ox", "qipao", "fire_dragon", "tiger", "yellow_dragon", "hula", "surf", "chill", "sneaky_seal", "turtle", "canada", "usa", "uk", "bitcoin_beach", "pumpkin", "monster", "mummy", "vampire", "witch", "black_cat", "zombie", "skeleton", "ghost_laura", "ghost_george", "santa", "rudolph", "snowman", "elf", "gingerbread", "taylor", "lily", "skipper", "jacob", "nutcracker", "turkey", "nye_2021", "valentine", "leprechaun", "thanksgiving", "nye_2022", "air", "water", "earth", "fire", "sushi_chef", "master_sushi_chef", "construction", "foreman", "rng", "tiki_chief", "architect", "marshaller", "jamie", "natalie", "angela", "laura", "george", "wombat", "doge", "veriblock", "suku", "pat_morita", "ecuador_football", "argentina_football", "australia_football", "iran_football", "france_football", "saudi_arabia_football", "qatar_football", "cameroon_football", "brazil_football", "switzerland_football", "denmark_football", "england_football", "netherlands_football", "poland_footbal", "united_states_football", "wales_football", "costa_rica_football", "japan_football", "canada_football", "senegal_football", "mexico_football", "tunisia_football", "south_korea_football", "germany_football", "uruguay_football", "croatia_football", "belgium_football", "spain_football", "serbia_football", "portugal_football", "morocco_football", "ghana_football", "scorpio", "sagittarius");
// get all the terms from ezformatter
// loop over the terms
// build the division and echo it
$totalstuffinarray = sizeof($newarray);

for($x=0;$x<$totalstuffinarray;$x++) {

$currentterm = $newarray[$x];

$appendo = "";
 if ($arrayofcubiesHAS[$x] === "1") { 
    
    $appendo = " checked ";

} 
$appendobought = "";
 if ($arrayofcubiesBOUGHT[$x] === "1") { 
    
    $appendobought = " checked ";

} 

$appendoprint = "";
 if ($arrayofcubiesPRINT[$x] === "1") { 
    
    $appendoprint = " checked ";

} 

    
    $everythinginsidethisdivclass = '<div class="form-popup" id="form-'.$currentterm.'">
        <form action="/action_page.php" class="form-container">
        <img id="form-img-'.$currentterm.'" src="">
        <table>
        <tr>
        <td class="form-cell">Owned</td>
        <td class="form-cell"><input type="checkbox" id="check_owned_'.$currentterm.'" name="check_owned_'.$currentterm.'" class="regular-checkbox" '.$appendo.' onchange="updateOriginal(\'check_'.$currentterm.'\', \'check_owned_'.$currentterm.'\'), bgChange(check_'.$currentterm.')"  onclick="forceSubmit(this.name);" ></td>
        </tr>
        <tr>
        <td class="form-cell">Bought</td>
        <td class="form-cell">
        <div><script language="javascript">if ("check_bought_'.$currenterm.'_form" == "check_bought_blue_form") { alert("mimi"); } </script>
        <form method="POST" action="cubie-includes/checkbox-cubie-bought.inc.php" id="check_bought_'.$currenterm.'_form" name="check_bought_'.$currentterm.'_form">
        <input type="checkbox" id="check_bought_'.$currentterm.'" name="check_bought_'.$currentterm.'" onclick="forceSubmitBought(this.name);" class="regular-checkbox" '.$appendobought.' onchange=""><input type="button" value="check_bought_'.$currentterm.'_form">
        <input type="hidden" id="check_bought_'.$currentterm.'_hidden" name="check_bought_'.$currentterm.'_hidden"></form></div>
        </td>        
        </tr>
        <tr>
        <td class="form-cell">Printed</td>
        <td class="form-cell"><input type="checkbox" id="check_printed_'.$currentterm.'" name="check_printed_'.$currentterm.'" class="regular-checkbox" '.$appendoprint.' onchange=""></td>
        </tr>
        </table>
        <br>
        <button type="button" class="btn cancel" onclick="closeForm(\'form-'.$currentterm.'\')">Close</button>
        </form>
        </div>';

echo $everythinginsidethisdivclass;

}

?>



<!-- Force the checkbox to submit when changed 
    fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff
    fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff
    fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff
    fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff   -->

<SCRIPT Language="javascript">

    function forceSubmit(formname) {
        if (formname.indexOf("_owned") != -1) {

            formname = formname.replace("_owned", "");

        }
    var nameofthehidden = formname+'_hidden';

    var statusofcheck=document.getElementById(formname).checked;
    
    var payload = "failure";
    
    if (statusofcheck == true){

        payload = "on"; 

    } else {
        payload = "off"; 
    }
        document.getElementById(nameofthehidden).value= payload;
        console.log("force submit occurred");
        document.forms[formname + "_form"].submit();
    }

    function forceSubmitBought(formname) { //check bought term hidden
 
    var nameofthehidden = formname+'_hidden';
console.log(nameofthehidden);
    var statusofcheck=document.getElementById(formname).checked;
    
    var payload = "failure";
    
    if (statusofcheck == true){

        payload = "on"; 

    } else {
        payload = "off"; 
    }
        document.getElementById(nameofthehidden).value= payload;
        console.log("force submit occurred for  "+ formname + "_form");
      
      if (document.getElementById(formname + "_form") != null) {
        alert("YAY");
      } else {
        alert("sad");
      }
      
      //  document.forms[formname + "_form"].submit();
    }

</SCRIPT>


<!-- Begin displaying main cubie page 
    fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff
    fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff
    fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff
    fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff   -->
<?php 

$incrementer = 0;

?>
<h1>Welcome To Your Cubiedex!</h1> 
<br>
<br>
    <table>
        <caption>Rainbow Cubies</caption>
        <tr>
            <td  <?php if ($arrayofcubiesHAS[$incrementer] === "1") { echo 'style="background-color:#A7ECF8"'; } ?>>
                <img src="cubie-images/Cubie-Blue_Cubie.png" data-img="cubie-images/Cubie-Blue_Cubie.png" alt="Blue Cubie" id="img_blue" name="img_blue" onclick="openForm('form-blue','check_blue','check_owned_blue','form-img-blue', this)">
                <br>
                Blue
                <br>
                <div>
                <form method="POST" action="cubie-includes/checkbox-cubie.inc.php" id="check_blue_form" name="check_blue_form">
                    <input type="checkbox" id="check_blue" name="check_blue" class="regular-checkbox" onchange="bgChange(this)" onclick="forceSubmit(this.name);" <?php if ($arrayofcubiesHAS[$incrementer] === "1") { echo 'checked'; } $incrementer += 1;  ?>>
                    <input type="hidden" id="check_blue_hidden" name="check_blue_hidden">
                </form>
                </div>
            </td>
            
            <td>
                <img src="cubie-images/Cubie-Green_Cubie.png" data-img="cubie-images/Cubie-Green_Cubie.png" alt="Green Cubie" id="img_green" name="img_green" onclick="openForm('form-green','check_green','check_owned_green', 'form-img-green', this)">
                <br>
                Green
                <br>
                <input type="checkbox" id="check_green" name="check_green" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Yellow_Cubie.png" data-img="cubie-images/Cubie-Yellow_Cubie.png" alt="Yellow Cubie" id="img_yellow" name="img_yellow" onclick="openForm('form-yellow','check_yellow','check_owned_yellow', 'form-img-yellow', this)">
                <br>
                Yellow
                <br>
                <input type="checkbox" id="check_yellow" name="check_yellow" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Red_Cubie.png" data-img="cubie-images/Cubie-Red_Cubie.png" alt="Red Cubie" id="img_red" name="img_red" onclick="openForm('form-red','check_red','check_owned_red', 'form-img-red', this)">
                <br>
                Red
                <br>
                <input type="checkbox" id="check_red" name="check_red" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Purple_Cubie.png" data-img="cubie-images/Cubie-Purple_Cubie.png" alt="Purple Cubie" id="img_purple" name="img_purple" onclick="openForm('form-purple','check_purple','check_owned_purple', 'form-img-purple', this)">
                <br>
                Purple
                <br>
                <input type="checkbox" id="check_purple" name="check_purple" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-White_Cubie.png" data-img="cubie-images/Cubie-White_Cubie.png" alt="White Cubie" id="img_white" name="img_white" onclick="openForm('form-white','check_white','check_owned_white', 'form-img-white', this)">
                <br>
                White
                <br>
                <input type="checkbox" id="check_white" name="check_white" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    </table>
<br> 
    <table>
        <caption>Shop Cubies (Individual)</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-OG_Cubie.png" data-img="cubie-images/Cubie-OG_Cubie.png" alt="OG Cubie" id="img_og" name="img_og" onclick="openForm('form-og','check_og','check_owned_og', 'form-img-og', this)">
                <br>
                OG
                <br>
                <input type="checkbox" id="check_og" name="check_og" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Bitcoin_Cubie.png" data-img="cubie-images/Cubie-Bitcoin_Cubie.png" alt="Bitcoin Cubie" id="img_bitcoin" name="img_bitcoin" onclick="openForm('form-bitcoin','check_bitcoin','check_owned_bitcoin', 'form-img-bitcoin', this)">
                <br>
                Bitcoin
                <br>
                <input type="checkbox" id="check_bitcoin" name="check_bitcoin" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Pirate_Captain_Cubie.png" data-img="cubie-images/Cubie-Pirate_Captain_Cubie.png" alt="Pirate Captain Cubie" id="img_pirate_captain" name="img_pirate_captain" onclick="openForm('form-pirate_captain','check_pirate_captain','check_owned_pirate_captain', 'form-img-pirate_captain', this)">
                <br>
                Pirate Captain
                <br>
                <input type="checkbox" id="check_pirate_captain" name="check_pirate_captain" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Ethereum_Cubie.png" data-img="cubie-images/Cubie-Ethereum_Cubie.png" alt="Ethereum Cubie" id="img_ethereum" name="img_ethereum" onclick="openForm('form-ethereum','check_ethereum','check_owned_ethereum', 'form-img-ethereum', this)">
                <br>
                Ethereum
                <br>
                <input type="checkbox" id="check_ethereum" name="check_ethereum" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Shark_Cubie.png" data-img="cubie-images/Cubie-Shark_Cubie.png" alt="Shark Cubie" id="img_shark" name="img_shark" onclick="openForm('form-shark','check_shark','check_owned_shark', 'form-img-shark', this)">
                <br>
                Shark
                <br>
                <input type="checkbox" id="check_shark" name="check_shark" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Ice_Cubie.png" data-img="cubie-images/Cubie-Ice_Cubie.png" alt="Ice Cubie" id="img_ice" name="img_ice" onclick="openForm('form-ice','check_ice','check_owned_ice', 'form-img-ice', this)">
                <br>
                Ice
                <br>
                <input type="checkbox" id="check_ice" name="check_ice" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Pizza_Cubie.png" data-img="cubie-images/Cubie-Pizza_Cubie.png" alt="Pizza Cubie" id="img_pizza" name="img_pizza" onclick="openForm('form-pizza','check_pizza','check_owned_pizza', 'form-img-pizza', this)">
                <br>
                Pizza
                <br>
                <input type="checkbox" id="check_pizza" name="check_pizza" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Summer_Cubie.png" data-img="cubie-images/Cubie-Summer_Cubie.png" alt="Summer Cubie" id="img_summer" name="img_summer" onclick="openForm('form-summer','check_summer','check_owned_summer', 'form-img-summer', this)">
                <br>
                Summer
                <br>
                <input type="checkbox" id="check_summer" name="check_summer" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    </table>
<br>
  

        
<table>
        <caption>Cat Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Snoozy_Cat_Cubie.png" data-img="cubie-images/Cubie-Snoozy_Cat_Cubie.png"  onclick="openForm('form-snoozy','check_snoozy','check_owned_snoozy', 'form-img-snoozy', this)" alt="Snoozy Cubie" id="img_snoozy" name="img_snoozy">
                <br>
                Snoozy
                <br>
                <input type="checkbox" id="check_snoozy" name="check_snoozy" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Boba_Cat_Cubie.png" data-img="cubie-images/Cubie-Boba_Cat_Cubie.png"  onclick="openForm('form-boba','check_boba','check_owned_boba', 'form-img-boba', this)" alt="Boba Cubie" id="img_boba" name="img_boba">
                <br>
                Boba
                <br>
                <input type="checkbox" id="check_boba" name="check_boba" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Ronda_Cat_Cubie.png" data-img="cubie-images/Cubie-Ronda_Cat_Cubie.png"  onclick="openForm('form-ronda','check_ronda','check_owned_ronda', 'form-img-ronda', this)" alt="Ronda Cubie" id="img_ronda" name="img_ronda">
                <br>
                Ronda
                <br>
                <input type="checkbox" id="check_ronda" name="check_ronda" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Patches_Cat_Cubie.png" data-img="cubie-images/Cubie-Patches_Cat_Cubie.png"  onclick="openForm('form-patches','check_patches','check_owned_patches', 'form-img-patches', this)" alt="Patches Cubie" id="img_patches" name="name_patches">
                <br>
                Patches
                <br>
                <input type="checkbox" id="check_patches" name="check_patches" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Jett_Cat_Cubie.png" data-img="cubie-images/Cubie-Jett_Cat_Cubie.png"  onclick="openForm('form-jett','check_jett','check_owned_jett', 'form-img-jett', this)" alt="Jett Cubie" id="img_jett" name="img_jett">
                <br>
                Jett
                <br>
                <input type="checkbox" id="check_jett" name="check_jett" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Tiger_Lily_Cat_Cubie.png" data-img="cubie-images/Cubie-Tiger_Lily_Cat_Cubie.png"  onclick="openForm('form-tiger_lily','check_tiger_lily','check_owned_tiger_lily', 'form-img-tiger_lily', this)" alt="Tiger Lily Cubie" id="img_tiger_lily" name="img_tiger_lily">
                <br>
                Tiger Lily
                <br>
                <input type="checkbox" id="check_tiger_lily" name="check_tiger_lily" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Softy_Cat_Cubie.png" data-img="cubie-images/Cubie-Softy_Cat_Cubie.png"  onclick="openForm('form-softy','check_softy','check_owned_softy', 'form-img-softy', this)" alt="Softy Cubie" id="img_softy" name="img_softy">
                <br>
                Softy
                <br>
                <input type="checkbox" id="check_softy" name="check_softy" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Holly_Cat_Cubie.png" data-img="cubie-images/Cubie-Holly_Cat_Cubie.png"  onclick="openForm('form-holly','check_holly','check_owned_holly', 'form-img-holly', this)" alt="Holly Cubie" id="img_holly" name="img_holly">
                <br>
                Holly
                <br>
                <input type="checkbox" id="check_holly" name="check_holly" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Missy_Cat_Cubie.png" data-img="cubie-images/Cubie-Missy_Cat_Cubie.png"  onclick="openForm('form-missy','check_missy','check_owned_missy', 'form-img-missy', this)" alt="Missy Cubie" id="img_missy" name="img_missy">
                <br>
                Missy
                <br>
                <input type="checkbox" id="check_missy" name="check_missy" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Tiki Cubies - Thong Tribe</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Iki_Tiki_Cubie.png" data-img="cubie-images/Cubie-Iki_Tiki_Cubie.png"  onclick="openForm('form-iki','check_iki','check_owned_iki', 'form-img-iki', this)" alt="Iki Cubie" id="img_iki" name="img_iki">
                <br>
                Iki
                <br>
                <input type="checkbox" id="check_iki" name="check_iki" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Kuki_Tiki_Cubie.png" data-img="cubie-images/Cubie-Kuki_Tiki_Cubie.png"  onclick="openForm('form-kuki','check_kuki','check_owned_kuki', 'form-img-kuki', this)" alt="Kuki Cubie" id="img_kuki" name="img_kuki">
                <br>
                Kuki
                <br>
                <input type="checkbox" id="check_kuki" name="check_kuki" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Kauka_Tiki_Cubie.png" data-img="cubie-images/Cubie-Kauka_Tiki_Cubie.png"  onclick="openForm('form-kauka','check_kauka','check_owned_kauka', 'form-img-kauka', this)" alt="Kauka Cubie" id="img_kauka" name="img_kauka">
                <br>
                Kauka
                <br>
                <input type="checkbox" id="check_kauka" name="check_kauka" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Wawae_Tiki_Cubie.png" data-img="cubie-images/Cubie-Wawae_Tiki_Cubie.png"  onclick="openForm('form-wawae','check_wawae','check_owned_wawae', 'form-img-wawae', this)" alt="Wawae Cubie" id="img_wawae" name="img_wawae">
                <br>
                Wawae
                <br>
                <input type="checkbox" id="check_wawae" name="check_wawae" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Ino_Tiki_Cubie.png" data-img="cubie-images/Cubie-Ino_Tiki_Cubie.png"  onclick="openForm('form-ino','check_ino','check_owned_ino', 'form-img-ino', this)" alt="Ino Cubie" id="img_ino" name="img_ino">
                <br>
                Ino
                <br>
                <input type="checkbox" id="check_ino" name="check_ino" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Ka_Pu_Tiki_Cubie.png" data-img="cubie-images/Cubie-Ka_Pu_Tiki_Cubie.png"  onclick="openForm('form-ka_pu','check_ka_pu','check_owned_ka_pu', 'form-img-ka_pu', this)" alt="Ka Pu Cubie" id="img_ka_pu" name="img_ka_pu">
                <br>
                Ka Pu
                <br>
                <input type="checkbox" id="check_ka_pu" name="check_ka_pu" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Enemi_Tiki_Cubie.png" data-img="cubie-images/Cubie-Enemi_Tiki_Cubie.png"  onclick="openForm('form-enemi','check_enemi','check_owned_enemi', 'form-img-enemi', this)" alt="Enemi Cubie" id="img_enemi" name="img_enemi">
                <br>
                Enemi
                <br>
                <input type="checkbox" id="check_enemi" name="check_enemi" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Haohao_Tiki_Cubie.png" data-img="cubie-images/Cubie-Haohao_Tiki_Cubie.png"  onclick="openForm('form-haohao','check_haohao','check_owned_haohao', 'form-img-haohao', this)" alt="Haohao Cubie" id="img_haohao" name="img_haohao">
                <br>
                Haohao
                <br>
                <input type="checkbox" id="check_haohao" name="check_haohao" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Hihiu_Tiki_Cubie.png" data-img="cubie-images/Cubie-Hihiu_Tiki_Cubie.png"  onclick="openForm('form-hihiu','check_hihiu','check_owned_hihiu', 'form-img-hihiu', this)" alt="Hihiu Cubie" id="img_hihiu" name="img_hihiu">
                <br>
                Hihiu
                <br>
                <input type="checkbox" id="check_hihiu" name="check_hihiu" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Tiki Cubies - White Skirt Tribe</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Niho_Tiki_Cubie.png" data-img="cubie-images/Cubie-Niho_Tiki_Cubie.png"  onclick="openForm('form-niho','check_niho','check_owned_niho', 'form-img-niho', this)" alt="Niho Cubie" id="img_niho" name="img_niho">
                <br>
                Niho
                <br>
                <input type="checkbox" id="check_niho" name="check_niho" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Olioli_Tiki_Cubie.png" data-img="cubie-images/Cubie-Olioli_Tiki_Cubie.png"  onclick="openForm('form-olioli','check_olioli','check_owned_olioli', 'form-img-olioli', this)" alt="Olioli Cubie" id="img_olioli" name="img_olioli">
                <br>
                Olioli
                <br>
                <input type="checkbox" id="check_olioli" name="check_olioli" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Makeneki_Tiki_Cubie.png" data-img="cubie-images/Cubie-Makeneki_Tiki_Cubie.png"  onclick="openForm('form-makeneki','check_makeneki','check_owned_makeneki', 'form-img-makeneki', this)" alt="Makeneki Cubie" id="img_makeneki" name="img_makeneki">
                <br>
                Makeneki
                <br>
                <input type="checkbox" id="check_makeneki" name="check_makeneki" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Kopaa_Tiki_Cubie.png" data-img="cubie-images/Cubie-Kopaa_Tiki_Cubie.png"  onclick="openForm('form-kopaa','check_kopaa','check_owned_kopaa', 'form-img-kopaa', this)" alt="Kopaa Cubie" id="img_kopaa" name="img_kopaa">
                <br>
                Kopaa
                <br>
                <input type="checkbox" id="check_kopaa" name="check_kopaa" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Moo_Tiki_Cubie.png" data-img="cubie-images/Cubie-Moo_Tiki_Cubie.png"  onclick="openForm('form-moo','check_moo','check_owned_moo', 'form-img-moo', this)" alt="Mo'o Cubie" id="img_moo" name="img_moo">
                <br>
                Mo'o
                <br>
                <input type="checkbox" id="check_moo" name="check_moo" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Anu_Tiki_Cubie.png" data-img="cubie-images/Cubie-Anu_Tiki_Cubie.png"  onclick="openForm('form-anu','check_anu','check_owned_anu', 'form-img-anu', this)" alt="Anu Cubie" id="img_anu" name="img_anu">
                <br>
                Anu
                <br>
                <input type="checkbox" id="check_anu" name="check_anu" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Pohaku_Tiki_Cubie.png" data-img="cubie-images/Cubie-Pohaku_Tiki_Cubie.png"  onclick="openForm('form-pohaku','check_pohaku','check_owned_pohaku', 'form-img-pohaku', this)" alt="Pohaku Cubie" id="img_pohaku" name="img_pohaku">
                <br>
                Pohaku
                <br>
                <input type="checkbox" id="check_pohaku" name="check_pohaku" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Hamau_Tiki_Cubie.png" data-img="cubie-images/Cubie-Hamau_Tiki_Cubie.png"  onclick="openForm('form-hamau','check_hamau','check_owned_hamau', 'form-img-hamau', this)" alt="Hamau Cubie" id="img_hamau" name="img_hamau">
                <br>
                Hamau
                <br>
                <input type="checkbox" id="check_hamau" name="check_hamau" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Metala_Tiki_Cubie.png" data-img="cubie-images/Cubie-Metala_Tiki_Cubie.png"  onclick="openForm('form-metala','check_metala','check_owned_metala', 'form-img-metala', this)" alt="Metala Cubie" id="img_metala" name="img_metala">
                <br>
                Metala
                <br>
                <input type="checkbox" id="check_metala" name="check_metala" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Tiki Cubies - Green Skirt Tribe</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Kaka_Tiki_Cubie.png" data-img="cubie-images/Cubie-Kaka_Tiki_Cubie.png"  onclick="openForm('form-kaka','check_kaka','check_owned_kaka', 'form-img-kaka', this)" alt="Kaka Cubie" id="img_kaka" name="img_kaka">
                <br>
                Kaka
                <br>
                <input type="checkbox" id="check_kaka" name="check_kaka" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Paipika_Tiki_Cubie.png" data-img="cubie-images/Cubie-Paipika_Tiki_Cubie.png"  onclick="openForm('form-paipika','check_paipika','check_owned_paipika', 'form-img-paipika', this)" alt="Paipika Cubie" id="img_paipika" name="img_paipika">
                <br>
                Paipika
                <br>
                <input type="checkbox" id="check_paipika" name="check_paipika" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Hookahi_Tiki_Cubie.png" data-img="cubie-images/Cubie-Hookahi_Tiki_Cubie.png"  onclick="openForm('form-hookahi','check_hookahi','check_owned_hookahi', 'form-img-hookahi', this)" alt="Hookahi Cubie" id="img_hookahi" name="img_hookahi">
                <br>
                Hookahi
                <br>
                <input type="checkbox" id="check_hookahi" name="check_hookahi" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Luna_Tiki_Cubie.png" data-img="cubie-images/Cubie-Luna_Tiki_Cubie.png"  onclick="openForm('form-luna','check_luna','check_owned_luna', 'form-img-luna', this)" alt="Luna Cubie" id="img_luna" name="img_luna">
                <br>
                Luna
                <br>
                <input type="checkbox" id="check_luna" name="check_luna" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Kaulana_Tiki_Cubie.png" data-img="cubie-images/Cubie-Kaulana_Tiki_Cubie.png"  onclick="openForm('form-kaulana','check_kaulana','check_owned_kaulana', 'form-img-kaulana', this)" alt="Kaulana Cubie" id="img_kaulana" name="img_kaulana">
                <br>
                Kaulana
                <br>
                <input type="checkbox" id="check_kaulana" name="check_kaulana" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Koa_Tiki_Cubie.png" data-img="cubie-images/Cubie-Koa_Tiki_Cubie.png"  onclick="openForm('form-koa','check_koa','check_owned_koa', 'form-img-koa', this)" alt="Koa Cubie" id="img_koa" name="img_koa">
                <br>
                Koa
                <br>
                <input type="checkbox" id="check_koa" name="check_koa" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Nani_Tiki_Cubie.png" data-img="cubie-images/Cubie-Nani_Tiki_Cubie.png"  onclick="openForm('form-nani','check_nani','check_owned_nani', 'form-img-nani', this)" alt="Nani Cubie" id="img_nani" name="img_nani">
                <br>
                Nani
                <br>
                <input type="checkbox" id="check_nani" name="check_nani" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Pila_Tiki_Cubie.png" data-img="cubie-images/Cubie-Pila_Tiki_Cubie.png"  onclick="openForm('form-pila','check_pila','check_owned_pila', 'form-img-pila', this)" alt="Pila Cubie" id="img_pila" name="img_pila">
                <br>
                Pila
                <br>
                <input type="checkbox" id="check_pila" name="check_pila" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Kelepona_Tiki_Cubie.png" data-img="cubie-images/Cubie-Kelepona_Tiki_Cubie.png"  onclick="openForm('form-kelepona','check_kelepona','check_owned_kelepona', 'form-img-kelepona', this)" alt="Kelepona Cubie" id="img_kelepona" name="img_kelepona">
                <br>
                Kelepona
                <br>
                <input type="checkbox" id="check_kelepona" name="check_kelepona" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Chinese New Year Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Ox_Cubie.png" data-img="cubie-images/Cubie-Ox_Cubie.png"  onclick="openForm('form-ox','check_ox','check_owned_ox', 'form-img-ox', this)" alt="Ox Cubie" id="img_ox" name="img_ox">
                <br>
                Ox
                <br>
                <input type="checkbox" id="check_ox" name="check_ox" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Qipao_Cubie.png" data-img="cubie-images/Cubie-Qipao_Cubie.png"  onclick="openForm('form-qipao','check_qipao','check_owned_qipao', 'form-img-qipao', this)" alt="Qipao Cubie" id="img_qipao" name="img_qipao">
                <br>
                Qipao
                <br>
                <input type="checkbox" id="check_qipao" name="check_qipao" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Fire_Dragon_Cubie.png" data-img="cubie-images/Cubie-Fire_Dragon_Cubie.png"  onclick="openForm('form-fire_dragon','check_fire_dragon','check_owned_fire_dragon', 'form-img-fire_dragon', this)" alt="Fire Dragon Cubie" id="img_fire_dragon" name="img_fire_dragon">
                <br>
                Fire Dragon
                <br>
                <input type="checkbox" id="check_fire_dragon" name="check_fire_dragon" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Tiger_Cubie.png" data-img="cubie-images/Cubie-Tiger_Cubie.png"  onclick="openForm('form-tiger','check_tiger','check_owned_tiger', 'form-img-tiger', this)" alt="Tiger Cubie" id="img_tiger" name="img_tiger">
                <br>
                Tiger
                <br>
                <input type="checkbox" id="check_tiger" name="check_tiger" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Yellow_Dragon_Cubie.png" data-img="cubie-images/Cubie-Yellow_Dragon_Cubie.png"  onclick="openForm('form-yellow_dragon','check_yellow_dragon','check_owned_yellow_dragon', 'form-img-yellow_dragon', this)" alt="Yellow Dragon Cubie" id="img_yellow_dragon" name="img_yellow_dragon">
                <br>
                Yellow Dragon
                <br>
                <input type="checkbox" id="check_yellow_dragon" name="check_yellow_dragon" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Hawaii Special Event Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Hula_Cubie.png" data-img="cubie-images/Cubie-Hula_Cubie.png"  onclick="openForm('form-hula','check_hula','check_owned_hula', 'form-img-hula', this)" alt="Hula Cubie" id="img_hula" name="img_hula">
                <br>
                Hula
                <br>
                <input type="checkbox" id="check_hula" name="check_hula" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Surf_Cubie.png" data-img="cubie-images/Cubie-Surf_Cubie.png"  onclick="openForm('form-surf','check_surf','check_owned_surf', 'form-img-surf', this)" alt="Surf Cubie" id="img_surf" name="img_surf">
                <br>
                Surf
                <br>
                <input type="checkbox" id="check_surf" name="check_surf" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Chill_Cubie.png" data-img="cubie-images/Cubie-Chill_Cubie.png"  onclick="openForm('form-chill','check_chill','check_owned_chill', 'form-img-chill', this)" alt="Chill Cubie" id="img_chill" name="img_chill">
                <br>
                Chill
                <br>
                <input type="checkbox" id="check_chill" name="check_chill" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Sneaky_Seal_Cubie.png" data-img="cubie-images/Cubie-Sneaky_Seal_Cubie.png"  onclick="openForm('form-sneaky_seal','check_sneaky_seal','check_owned_sneaky_seal', 'form-img-sneaky_seal', this)" alt="Sneaky Seal Cubie" id="img_sneaky_seal" name="img_sneaky_seal">
                <br>
                Sneaky Seal
                <br>
                <input type="checkbox" id="check_sneaky_seal" name="check_sneaky_seal" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Turtle_Cubie.png" data-img="cubie-images/Cubie-Turtle_Cubie.png"  onclick="openForm('form-turtle','check_turtle','check_owned_turtle', 'form-img-turtle', this)" alt="Turtle Cubie" id="img_turtle" name="img_turtle">
                <br>
                Turtle
                <br>
                <input type="checkbox" id="check_turtle" name="check_turtle" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Country Event Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Canada_Cubie.png" data-img="cubie-images/Cubie-Canada_Cubie.png"  onclick="openForm('form-canada','check_canada','check_owned_canada', 'form-img-canada', this)" alt="Canada Cubie" id="img_canada" name="img_canada">
                <br>
                Canada
                <br>
                <input type="checkbox" id="check_canada" name="check_canada" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-USA_Cubie.png" data-img="cubie-images/Cubie-USA_Cubie.png"  onclick="openForm('form-usa','check_usa','check_owned_usa', 'form-img-usa', this)" alt="USA Cubie" id="img_usa" name="img_usa">
                <br>
                USA
                <br>
                <input type="checkbox" id="check_usa" name="check_usa" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-UK_Cubie.png" data-img="cubie-images/Cubie-UK_Cubie.png"  onclick="openForm('form-uk','check_uk','check_owned_uk', 'form-img-uk', this)" alt="UK Cubie" id="img_uk" name="img_uk">
                <br>
                UK
                <br>
                <input type="checkbox" id="check_uk" name="check_uk" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Bitcoin_Beach_Cubie.png" data-img="cubie-images/Cubie-Bitcoin_Beach_Cubie.png"  onclick="openForm('form-bitcoin_beach','check_bitcoin_beach','check_owned_bitcoin_beach', 'form-img-bitcoin_beach', this)" alt="Bitcoin Beach Cubie" id="img_bitcoin_beach" name="img_bitcoin_beach">
                <br>
                Bitcoin Beach 
                <br>
                <input type="checkbox" id="check_bitcoin_beach" name="check_bitcoin_beach" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Halloween Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Pumpkin_Cubie.png" data-img="cubie-images/Cubie-Pumpkin_Cubie.png"  onclick="openForm('form-pumpkin','check_pumpkin','check_owned_pumpkin', 'form-img-pumpkin', this)" alt="Pumpkin Cubie" id="img_pumpkin" name="img_pumpkin">
                <br>
                Pumpkin
                <br>
                <input type="checkbox" id="check_pumpkin" name="check_pumpkin" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Monster_Cubie.png" data-img="cubie-images/Cubie-Monster_Cubie.png"  onclick="openForm('form-monster','check_monster','check_owned_monster', 'form-img-monster', this)" alt="Monster Cubie" id="img_monster" name="img_monster">
                <br>
                Monster
                <br>
                <input type="checkbox" id="check_monster" name="check_monster" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Mummy_Cubie.png" data-img="cubie-images/Cubie-Mummy_Cubie.png"  onclick="openForm('form-mummy','check_mummy','check_owned_mummy', 'form-img-mummy', this)" alt="Mummy Cubie" id="img_mummy" name="img_mummy">
                <br>
                Mummy
                <br>
                <input type="checkbox" id="check_mummy" name="check_mummy" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Vampire_Cubie.png" data-img="cubie-images/Cubie-Vampire_Cubie.png"  onclick="openForm('form-vampire','check_vampire','check_owned_vampire', 'form-img-vampire', this)" alt="Vampire Cubie" id="img_vampire" name="img_vampire">
                <br>
                Vampire
                <br>
                <input type="checkbox" id="check_vampire" name="check_vampire" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Witch_Cubie.png" data-img="cubie-images/Cubie-Witch_Cubie.png"  onclick="openForm('form-witch','check_witch','check_owned_witch', 'form-img-witch', this)" alt="Witch Cubie" id="img_witch" name="img_witch">
                <br>
                Witch
                <br>
                <input type="checkbox" id="check_witch" name="check_witch" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Black_Cat_Cubie.png" data-img="cubie-images/Cubie-Black_Cat_Cubie.png"  onclick="openForm('form-black_cat','check_black_cat','check_owned_black_cat', 'form-img-black_cat', this)" alt="Black Cat Cubie" id="img_black_cat" name="img_black_cat">
                <br>
                Black Cat 
                <br>
                <input type="checkbox" id="check_black_cat" name="check_black_cat" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Zombie_Cubie.png" data-img="cubie-images/Cubie-Zombie_Cubie.png"  onclick="openForm('form-zombie','check_zombie','check_owned_zombie', 'form-img-zombie', this)" alt="Zombie Cubie" id="img_zombie" name="img_zombie">
                <br>
                Zombie
                <br>
                <input type="checkbox" id="check_zombie" name="check_zombie" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Skeleton_Cubie.png" data-img="cubie-images/Cubie-Skeleton_Cubie.png"  onclick="openForm('form-skeleton','check_skeleton','check_owned_skeleton', 'form-img-skeleton', this)" alt="Skeleton Cubie" id="img_skeleton" name="img_skeleton">
                <br>
                Skeleton 
                <br>
                <input type="checkbox" id="check_skeleton" name="check_skeleton" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Ghost_Laura_Cubie.png" data-img="cubie-images/Cubie-Ghost_Laura_Cubie.png"  onclick="openForm('form-ghost_laura','check_ghost_laura','check_owned_ghost_laura', 'form-img-ghost_laura', this)" alt="Ghost Laura Cubie" id="img_ghost_laura" name="img_ghost_laura">
                <br>
                Ghost Laura 
                <br>
                <input type="checkbox" id="check_ghost_laura" name="check_ghost_laura" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Ghost_George_Cubie.png" data-img="cubie-images/Cubie-Ghost_George_Cubie.png"  onclick="openForm('form-ghost_george','check_ghost_george','check_owned_ghost_george', 'form-img-ghost_george', this)" alt="Ghost George Cubie" id="img_ghost_george" name="img_ghost_george">
                <br>
                Ghost George
                <br>
                <input type="checkbox" id="check_ghost_george" name="check_ghost_george" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Christmas Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Santa_Cubie.png" data-img="cubie-images/Cubie-Santa_Cubie.png"  onclick="openForm('form-santa','check_santa','check_owned_santa', 'form-img-santa', this)" alt="Santa Cubie" id="img_santa" name="img_santa">
                <br>
                Santa 
                <br>
                <input type="checkbox" id="check_santa" name="check_santa" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Rudolph_Cubie.png" data-img="cubie-images/Cubie-Rudolph_Cubie.png"  onclick="openForm('form-rudolph','check_rudolph','check_owned_rudolph', 'form-img-rudolph', this)" alt="Rudolph Cubie" id="img_rudolph" name="img_rudolph">
                <br>
                Rudolph 
                <br>
                <input type="checkbox" id="check_rudolph" name="check_rudolph" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Snowman_Cubie.png" data-img="cubie-images/Cubie-Snowman_Cubie.png"  onclick="openForm('form-snowman','check_snowman','check_owned_snowman', 'form-img-snowman', this)" alt="Snowman Cubie" id="img_snowman" name="img_snowman">
                <br>
                Snowman 
                <br>
                <input type="checkbox" id="check_snowman" name="check_snowman" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Elf_Cubie.png" data-img="cubie-images/Cubie-Elf_Cubie.png"  onclick="openForm('form-elf','check_elf','check_owned_elf', 'form-img-elf', this)" alt="Elf Cubie" id="img_elf" name="img_elf">
                <br>
                Elf 
                <br>
                <input type="checkbox" id="check_elf" name="check_elf" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Gingerbread_Cubie.png" data-img="cubie-images/Cubie-Gingerbread_Cubie.png"  onclick="openForm('form-gingerbread','check_gingerbread','check_owned_gingerbread', 'form-img-gingerbread', this)" alt="Gingerbread Cubie" id="img_gingerbread" name="img_gingerbread">
                <br>
                Gingerbread 
                <br>
                <input type="checkbox" id="check_gingerbread" name="check_gingerbread" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Taylor_Cubie.png" data-img="cubie-images/Cubie-Taylor_Cubie.png"  onclick="openForm('form-taylor','check_taylor','check_owned_taylor', 'form-img-taylor', this)" alt="Taylor Cubie" id="img_taylor" name="img_taylor">
                <br>
                Taylor 
                <br>
                <input type="checkbox" id="check_taylor" name="check_taylor" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Lily_Cubie.png" data-img="cubie-images/Cubie-Lily_Cubie.png"  onclick="openForm('form-lily','check_lily','check_owned_lily', 'form-img-lily', this)" alt="Lily Cubie" id="img_lily" name="img_lily">
                <br>
                Lily 
                <br>
                <input type="checkbox" id="check_lily" name="check_lily" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Skipper_Cubie.png" data-img="cubie-images/Cubie-Skipper_Cubie.png"  onclick="openForm('form-skipper','check_skipper','check_owned_skipper', 'form-img-skipper', this)" alt="Skipper Cubie" id="img_skipper" name="img_skipper">
                <br>
                Skipper 
                <br>
                <input type="checkbox" id="check_skipper" name="check_skipper" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Jacob_Cubie.png" data-img="cubie-images/Cubie-Jacob_Cubie.png"  onclick="openForm('form-jacob','check_jacob','check_owned_jacob', 'form-img-jacob', this)" alt="Jacob Cubie" id="img_jacob" name="img_jacob">
                <br>
                Jacob 
                <br>
                <input type="checkbox" id="check_jacob" name="check_jacob" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Nutcracker_Cubie.png" data-img="cubie-images/Cubie-Nutcracker_Cubie.png"  onclick="openForm('form-nutcracker','check_nutcracker','check_owned_nutcracker', 'form-img-nutcracker', this)" alt="Nutcracker Cubie" id="img_nutcracker" name="img_nutcracker">
                <br>
                Nutcracker 
                <br>
                <input type="checkbox" id="check_nutcracker" name="check_nutcracker" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Other Holiday Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Turkey_Cubie.png" data-img="cubie-images/Cubie-Turkey_Cubie.png"  onclick="openForm('form-turkey','check_turkey','check_owned_turkey', 'form-img-turkey', this)" alt="Turkey Cubie" id="img_turkey" name="img_turkey">
                <br>
                Turkey 
                <br>
                <input type="checkbox" id="check_turkey" name="check_turkey" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-NewYears_Cubie.png" data-img="cubie-images/Cubie-NewYears_Cubie.png"  onclick="openForm('form-nye_2021','check_nye_2021','check_owned_nye_2021', 'form-img-nye_2021', this)" alt="New Year 2021 Cubie" id="img_nye_2021" name="img_nye_2021">
                <br>
                NYE 2021 
                <br>
                <input type="checkbox" id="check_nye_2021" name="check_nye_2021" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Valentine_Cubie.png" data-img="cubie-images/Cubie-Valentine_Cubie.png"  onclick="openForm('form-valentine','check_valentine','check_owned_valentine', 'form-img-valentine', this)" alt="Valentine Cubie" id="img_valentine" name="img_valentine">
                <br>
                Valentine 
                <br>
                <input type="checkbox" id="check_valentine" name="check_valentine" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Leprechaun_Cubie.png" data-img="cubie-images/Cubie-Leprechaun_Cubie.png"  onclick="openForm('form-leprechaun','check_leprechaun','check_owned_leprechaun', 'form-img-leprechaun', this)" alt="Leprechaun Cubie" id="img_leprechaun" name="img_leprechaun">
                <br>
                Leprechaun 
                <br>
                <input type="checkbox" id="check_leprechaun" name="check_leprechaun" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Thanksgiving_Cubie.png" data-img="cubie-images/Cubie-Thanksgiving_Cubie.png"  onclick="openForm('form-thanksgiving','check_thanksgiving','check_owned_thanksgiving', 'form-img-thanksgiving', this)" alt="Thanksgiving Cubie" id="img_thanksgiving" name="img_thanksgiving">
                <br>
                Thanksgiving 
                <br>
                <input type="checkbox" id="check_thanksgiving" name="check_thanksgiving" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-New_Year_2022_Cubie.png" data-img="cubie-images/Cubie-New_Year_2022_Cubie.png"  onclick="openForm('form-nye_2022','check_nye_2022','check_owned_nye_2022', 'form-img-nye_2022', this)" alt="New Year 2022 Cubie" id="img_nye_2022" name="img_nye_2022">
                <br>
                NYE 2022 
                <br>
                <input type="checkbox" id="check_nye_2022" name="check_nye_2022" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Elemental Invasion Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Air_Cubie.png" data-img="cubie-images/Cubie-Air_Cubie.png"  onclick="openForm('form-air','check_air','check_owned_air', 'form-img-air', this)" alt="Air Cubie" id="img_air" name="img_air">
                <br>
                Air 
                <br>
                <input type="checkbox" id="check_air" name="check_air" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Water_Cubie.png" data-img="cubie-images/Cubie-Water_Cubie.png"  onclick="openForm('form-water','check_water','check_owned_water', 'form-img-water', this)" alt="Water Cubie" id="img_water" name="img_water">
                <br>
                Water 
                <br>
                <input type="checkbox" id="check_water" name="check_water" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Earth_Cubie.png" data-img="cubie-images/Cubie-Earth_Cubie.png"  onclick="openForm('form-earth','check_earth','check_owned_earth', 'form-img-earth', this)" alt="Earth Cubie" id="img_earth" name="img_earth">
                <br>
                Earth 
                <br>
                <input type="checkbox" id="check_earth" name="check_earth" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Fire_Cubie.png" data-img="cubie-images/Cubie-Fire_Cubie.png"  onclick="openForm('form-fire','check_fire','check_owned_fire', 'form-img-fire', this)" alt="Fire Cubie" id="img_fire" name="img_fire">
                <br>
                Fire 
                <br>
                <input type="checkbox" id="check_fire" name="check_fire" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Builder and Structure Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Sushi_Chef_Cubie.png" data-img="cubie-images/Cubie-Sushi_Chef_Cubie.png"  onclick="openForm('form-sushi_chef','check_sushi_chef','check_owned_sushi_chef', 'form-img-sushi_chef', this)" alt="Sushi Chef Cubie" id="img_sushi_chef" name="img_sushi_chef">
                <br>
                Sushi Chef 
                <br>
                <input type="checkbox" id="check_sushi_chef" name="check_sushi_chef" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Master_Sushi_Chef_Cubie.png" data-img="cubie-images/Cubie-Master_Sushi_Chef_Cubie.png"  onclick="openForm('form-master_sushi_chef','check_master_sushi_chef','check_owned_master_sushi_chef', 'form-img-master_sushi_chef', this)" alt="Master Sushi Chef Cubie" id="img_master_sushi_chef" name="img_master_sushi_chef">
                <br>
                Master Sushi Chef
                <br>
                <input type="checkbox" id="check_master_sushi_chef" name="check_master_sushi_chef" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Construction_Cubie.png" data-img="cubie-images/Cubie-Construction_Cubie.png"  onclick="openForm('form-construction','check_construction','check_owned_construction', 'form-img-construction', this)" alt="Construction Cubie" id="img_construction" name="img_construction">
                <br>
                Construction 
                <br>
                <input type="checkbox" id="check_construction" name="check_construction" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Foreman_Cubie.png" data-img="cubie-images/Cubie-Foreman_Cubie.png"  onclick="openForm('form-foreman','check_foreman','check_owned_foreman', 'form-img-foreman', this)" alt="Foreman Cubie" id="img_foreman" name="img_foreman">
                <br>
                Foreman 
                <br>
                <input type="checkbox" id="check_foreman" name="check_foreman" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-RNG_Cubie.png" data-img="cubie-images/Cubie-RNG_Cubie.png"  onclick="openForm('form-rng','check_rng','check_owned_rng', 'form-img-rng', this)" alt="RNG Cubie" id="img_rng" name="img_rng">
                <br>
                RNG 
                <br>
                <input type="checkbox" id="check_rng" name="check_rng" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Tiki_Chief_Cubie.png" data-img="cubie-images/Cubie-Tiki_Chief_Cubie.png"  onclick="openForm('form-tiki_chief','check_tiki_chief','check_owned_tiki_chief', 'form-img-tiki_chief', this)" alt="Tiki Chief Cubie" id="img_tiki_chief" name="img_tiki_chief">
                <br>
                Tiki Chief 
                <br>
                <input type="checkbox" id="check_tiki_chief" name="check_tiki_chief" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Architect_Cubie.png" data-img="cubie-images/Cubie-Architect_Cubie.png"  onclick="openForm('form-architect','check_architect','check_owned_architect', 'form-img-architect', this)" alt="Architect Cubie" id="img_architect" name="img_architect">
                <br>
                Architect
                <br>
                <input type="checkbox" id="check_architect" name="check_architect" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Cubie Air Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Marshaller_Cubie.png" data-img="cubie-images/Cubie-Marshaller_Cubie.png"  onclick="openForm('form-marshaller','check_marshaller','check_owned_marshaller', 'form-img-marshaller', this)" alt="Marshaller Cubie" id="img_marshaller" name="img_marshaller">
                <br>
                Marshaller 
                <br>
                <input type="checkbox" id="check_marshaller" name="check_marshaller" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Cubie_Air_Jamie.png" data-img="cubie-images/Cubie-Cubie_Air_Jamie.png"  onclick="openForm('form-jamie','check_jamie','check_owned_jamie', 'form-img-jamie', this)" alt="Jamie Cubie" id="img_jamie" name="img_jamie">
                <br>
                Jamie
                <br>
                <input type="checkbox" id="check_jamie" name="check_jamie" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Cubie_Air_Natalie.png" data-img="cubie-images/Cubie-Cubie_Air_Natalie.png"  onclick="openForm('form-natalie','check_natalie','check_owned_natalie', 'form-img-natalie', this)" alt="Natalie Cubie" id="img_natalie" name="img_natalie">
                <br>
                Natalie
                <br>
                <input type="checkbox" id="check_natalie" name="check_natalie" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Cubie_Air_Angela.png" data-img="cubie-images/Cubie-Cubie_Air_Angela.png"  onclick="openForm('form-angela','check_angela','check_owned_angela', 'form-img-angela', this)" alt="Angela Cubie" id="img_angela" name="img_angela">
                <br>
                Angela
                <br>
                <input type="checkbox" id="check_angela" name="check_angela" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Cubie_Air_Laura.png" data-img="cubie-images/Cubie-Cubie_Air_Laura.png"  onclick="openForm('form-laura','check_laura','check_owned_laura', 'form-img-laura', this)" alt="Laura Cubie" id="img_laura" name="img_laura">
                <br>
                Laura
                <br>
                <input type="checkbox" id="check_laura" name="check_laura" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Cubie_Air_George.png" data-img="cubie-images/Cubie-Cubie_Air_George.png"  onclick="openForm('form-george','check_george','check_owned_george', 'form-img-george', this)" alt="George Cubie" id="img_george" name="img_george">
                <br>
                George
                <br>
                <input type="checkbox" id="check_george" name="check_george" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Wombat_Cubie.png" data-img="cubie-images/Cubie-Wombat_Cubie.png"  onclick="openForm('form-wombat','check_wombat','check_owned_wombat', 'form-img-wombat', this)" alt="Wombat Cubie" id="img_wombat" name="img_wombat">
                <br>
                Wombat
                <br>
                <input type="checkbox" id="check_wombat" name="check_wombat" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Partnership Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Doge_Cubie.png" data-img="cubie-images/Cubie-Doge_Cubie.png"  onclick="openForm('form-doge','check_doge','check_owned_doge', 'form-img-doge', this)" alt="Doge Cubie" id="img_doge" name="img_doge">
                <br>
                Doge
                <br>
                <input type="checkbox" id="check_doge" name="check_doge" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Veriblock_Cubie.png" data-img="cubie-images/Cubie-Veriblock_Cubie.png"  onclick="openForm('form-veriblock','check_veriblock','check_owned_veriblock', 'form-img-veriblock', this)" alt="Veriblock Cubie" id="img_veriblock" name="img_veriblock">
                <br>
                Veriblock
                <br>
                <input type="checkbox" id="check_veriblock" name="check_veriblock" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Suku_Cubie.png" data-img="cubie-images/Cubie-Suku_Cubie.png"  onclick="openForm('form-suku','check_suku','check_owned_suku', 'form-img-suku', this)" alt="Suku Cubie" id="img_suku" name="img_suku">
                <br>
                Suku
                <br>
                <input type="checkbox" id="check_suku" name="check_suku" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Pat_Morita_Cubie.png" data-img="cubie-images/Cubie-Pat_Morita_Cubie.png"  onclick="openForm('form-pat_morita','check_pat_morita','check_owned_pat_morita', 'form-img-pat_morita', this)" alt="Pat Morita Cubie" id="img_pat_morita" name="img_pat_morita">
                <br>
                Pat Morita
                <br>
                <input type="checkbox" id="check_pat_morita" name="check_pat_morita" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>World Cup 2022 Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Ecuador_Football_Cubie.png" data-img="cubie-images/Cubie-Ecuador_Football_Cubie.png"  onclick="openForm('form-ecuador_football','check_ecuador_football','check_owned_ecuador_football', 'form-img-ecuador_football', this)" alt="Ecuador Football Cubie" id="img_ecuador_football" name="img_ecuador_football">
                <br>
                Ecuador
                <br>
                <input type="checkbox" id="check_ecuador_football" name="check_ecuador_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Argentina_Football_Cubie.png" data-img="cubie-images/Cubie-Argentina_Football_Cubie.png"  onclick="openForm('form-argentina_football','check_argentina_football','check_owned_argentina_football', 'form-img-argentina_football', this)" alt="Argentina Football Cubie" id="img_argentina_football" name="img_argentina_football">
                <br>
                Argentina
                <br>
                <input type="checkbox" id="check_argentina_football" name="check_argentina_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Australia_Football_Cubie.png" data-img="cubie-images/Cubie-Australia_Football_Cubie.png"  onclick="openForm('form-australia_football','check_australia_football','check_owned_australia_football', 'form-img-australia_football', this)" alt="Australia Football Cubie" id="img_australia_football" name="img_australia_football">
                <br>
                Australia
                <br>
                <input type="checkbox" id="check_australia_football" name="check_australia_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Iran_Football_Cubie.png" data-img="cubie-images/Cubie-Iran_Football_Cubie.png"  onclick="openForm('form-iran_football','check_iran_football','check_owned_iran_football', 'form-img-iran_football', this)" alt="Iran Football Cubie" id="img_iran_football" name="img_iran_football">
                <br>
                Iran
                <br>
                <input type="checkbox" id="check_iran_football" name="check_iran_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-France_Football_Cubie.png" data-img="cubie-images/Cubie-France_Football_Cubie.png"  onclick="openForm('form-france_football','check_france_football','check_owned_france_football', 'form-img-france_football', this)" alt="France Football Cubie" id="img_france_football" name="img_france_football">
                <br>
                France
                <br>
                <input type="checkbox" id="check_france_football" name="check_france_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Saudi_Arabia_Football_Cubie.png" data-img="cubie-images/Cubie-Saudi_Arabia_Football_Cubie.png"  onclick="openForm('form-saudi_arabia_football','check_saudi_arabia_football','check_owned_saudi_arabia_football', 'form-img-saudi_arabia_football', this)" alt="Saudi Arabia Football Cubie" id="img_saudi_arabia_football" name="img_saudi_arabia_football">
                <br>
                Saudi Arabia
                <br>
                <input type="checkbox" id="check_saudi_arabia_football" name="check_saudi_arabia_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Qatar_Football_Cubie.png" data-img="cubie-images/Cubie-Qatar_Football_Cubie.png"  onclick="openForm('form-qatar_football','check_qatar_football','check_owned_qatar_football', 'form-img-qatar_football', this)" alt="Qatar Football Cubie" id="img_qatar_football" name="img_qatar_football">
                <br>
                Qatar
                <br>
                <input type="checkbox" id="check_qatar_football" name="check_qatar_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Cameroon_Football_Cubie.png" data-img="cubie-images/Cubie-Cameroon_Football_Cubie.png"  onclick="openForm('form-cameroon_football','check_cameroon_football','check_owned_cameroon_football', 'form-img-cameroon_football', this)" alt="Cameroon Football Cubie" id="img_cameroon_football" name="img_cameroon_football">
                <br>
                Cameroon
                <br>
                <input type="checkbox" id="check_cameroon_football" name="check_cameroon_football" class="regular-checkbox" onchange="bgChange(this)">
            
       <!-- </tr>
        <tr> -->
            <td>
                <img src="cubie-images/Cubie-Brazil_Football_Cubie.png" data-img="cubie-images/Cubie-Brazil_Football_Cubie.png"  onclick="openForm('form-brazil_football','check_brazil_football','check_owned_brazil_football', 'form-img-brazil_football', this)" alt="Brazil Football Cubie" id="img_brazil_football" name="img_brazil_football">
                <br>
                Brazil
                <br>
                <input type="checkbox" id="check_brazil_football" name="check_brazil_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Switzerland_Football_Cubie.png" data-img="cubie-images/Cubie-Switzerland_Football_Cubie.png"  onclick="openForm('form-switzerland_football','check_switzerland_football','check_owned_switzerland_football', 'form-img-switzerland_football', this)" alt="Switzerland Football Cubie" id="img_switzerland_football" name="img_switzerland_football">
                <br>
                Switzerland
                <br>
                <input type="checkbox" id="check_switzerland_football" name="check_switzerland_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Denmark_Football_Cubie.png" data-img="cubie-images/Cubie-Denmark_Football_Cubie.png"  onclick="openForm('form-denmark_football','check_denmark_football','check_owned_denmark_football', 'form-img-denmark_football', this)" alt="Denmark Football Cubie" id="img_denmark_football" name="img_denmark_football">
                <br>
                Denmark
                <br>
                <input type="checkbox" id="check_denmark_football" name="check_denmark_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-England_Football_Cubie.png" data-img="cubie-images/Cubie-England_Football_Cubie.png"  onclick="openForm('form-england_football','check_england_football','check_owned_england_football', 'form-img-england_football', this)" alt="England Football Cubie" id="img_england_football" name="img_england_football">
                <br>
                England
                <br>
                <input type="checkbox" id="check_england_football" name="check_england_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Netherlands_Football_Cubie.png" data-img="cubie-images/Cubie-Netherlands_Football_Cubie.png"  onclick="openForm('form-netherlands_football','check_netherlands_football','check_owned_netherlands_football', 'form-img-netherlands_football', this)" alt="Netherlands Football Cubie" id="img_netherlands_football" name="img_netherlands_football">
                <br>
                Netherlands
                <br>
                <input type="checkbox" id="check_netherlands_football" name="check_netherlands_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Poland_Football_Cubie.png" data-img="cubie-images/Cubie-Poland_Football_Cubie.png"  onclick="openForm('form-poland_footbal','check_poland_footbal','check_owned_poland_footbal', 'form-img-poland_footbal', this)" alt="Poland Football Cubie" id="img_poland_footbal" name="img_poland_football">
                <br>
                Poland
                <br>
                <input type="checkbox" id="check_poland_football" name="check_poland_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-United_States_Football_Cubie.png" data-img="cubie-images/Cubie-United_States_Football_Cubie.png"  onclick="openForm('form-united_states_football','check_united_states_football','check_owned_united_states_football', 'form-img-united_states_football', this)" alt="United States Football Cubie" id="img_united_states_football" name="img_united_states_football">
                <br>
                United States
                <br>
                <input type="checkbox" id="check_united_states_football" name="check_united_states_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Wales_Football_Cubie.png" data-img="cubie-images/Cubie-Wales_Football_Cubie.png"  onclick="openForm('form-wales_football','check_wales_football','check_owned_wales_football', 'form-img-wales_football', this)" alt="Wales Football Cubie" id="img_wales_football" name="img_wales_football">
                <br>
                Wales
                <br>
                <input type="checkbox" id="check_wales_football" name="check_wales_football" class="regular-checkbox" onchange="bgChange(this)">
            
          <!-- </tr>
        <tr> -->
            <td>
                <img src="cubie-images/Cubie-Costa_Rica_Football_Cubie.png" data-img="cubie-images/Cubie-Costa_Rica_Football_Cubie.png"  onclick="openForm('form-costa_rica_football','check_costa_rica_football','check_owned_costa_rica_football', 'form-img-costa_rica_football', this)" alt="Costa Rica Football Cubie" id="img_costa_rica_football" name="img_costa_rica_football">
                <br>
                Costa Rica
                <br>
                <input type="checkbox" id="check_costa_rica_football" name="check_costa_rica_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Japan_Football_Cubie.png" data-img="cubie-images/Cubie-Japan_Football_Cubie.png"  onclick="openForm('form-japan_football','check_japan_football','check_owned_japan_football', 'form-img-japan_football', this)" alt="Japan Football Cubie" id="img_japan_football" name="img_japan_football">
                <br>
                Japan
                <br>
                <input type="checkbox" id="check_japan_football" name="check_japan_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Canada_Football_Cubie.png" data-img="cubie-images/Cubie-Canada_Football_Cubie.png"  onclick="openForm('form-canada_football','check_canada_football','check_owned_canada_football', 'form-img-canada_football', this)" alt="Canada Football Cubie" id="img_canada_football" name="img_canada_football">
                <br>
                Canada
                <br>
                <input type="checkbox" id="check_canada_football" name="check_canada_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Senegal_Football_Cubie.png" data-img="cubie-images/Cubie-Senegal_Football_Cubie.png"  onclick="openForm('form-senegal_football','check_senegal_football','check_owned_senegal_football', 'form-img-senegal_football', this)" alt="Senegal Football Cubie" id="img_senegal_football" name="img_senegal_football">
                <br>
                Senegal
                <br>
                <input type="checkbox" id="check_senegal_football" name="check_senegal_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Mexico_Football_Cubie.png" data-img="cubie-images/Cubie-Mexico_Football_Cubie.png"  onclick="openForm('form-mexico_football','check_mexico_football','check_owned_mexico_football', 'form-img-mexico_football', this)" alt="Mexico Football Cubie" id="img_mexico_football" name="img_mexico_football">
                <br>
                Mexico
                <br>
                <input type="checkbox" id="check_mexico_football" name="check_mexico_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Tunisia_Football_Cubie.png" data-img="cubie-images/Cubie-Tunisia_Football_Cubie.png"  onclick="openForm('form-tunisia_football','check_tunisia_football','check_owned_tunisia_football', 'form-img-tunisia_football', this)" alt="Tunisia Football Cubie" id="img_tunisia_football" name="img_tunisia_football">
                <br>
                Tunisia
                <br>
                <input type="checkbox" id="check_tunisia_football" name="check_tunisia_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-South_Korea_Football_Cubie.png" data-img="cubie-images/Cubie-South_Korea_Football_Cubie.png"  onclick="openForm('form-south_korea_football','check_south_korea_football','check_owned_south_korea_football', 'form-img-south_korea_football', this)" alt="South Korea Football Cubie" id="img_south_korea_football" name="img_south_korea_football">
                <br>
                South Korea
                <br>
                <input type="checkbox" id="check_south_korea_football" name="check_south_korea_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Germany_Football_Cubie.png" data-img="cubie-images/Cubie-Germany_Football_Cubie.png"  onclick="openForm('form-germany_football','check_germany_football','check_owned_germany_football', 'form-img-germany_football', this)" alt="Germany Football Cubie" id="img_germany_football" name="img_germany_football">
                <br>
                Germany
                <br>
                <input type="checkbox" id="check_germany_football" name="check_germany_football" class="regular-checkbox" onchange="bgChange(this)">
            
       <!--    </tr>
        <tr> -->
            <td>
                <img src="cubie-images/Cubie-Uruguay_Football_Cubie.png" data-img="cubie-images/Cubie-Uruguay_Football_Cubie.png"  onclick="openForm('form-uruguay_football','check_uruguay_football','check_owned_uruguay_football', 'form-img-uruguay_football', this)" alt="Uruguay Football Cubie" id="img_uruguay_football" name="img_uruguay_football">
                <br>
                Uruguay
                <br>
                <input type="checkbox" id="check_uruguay_football" name="check_uruguay_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Croatia_Football_Cubie.png" data-img="cubie-images/Cubie-Croatia_Football_Cubie.png"  onclick="openForm('form-croatia_football','check_croatia_football','check_owned_croatia_football', 'form-img-croatia_football', this)" alt="Croatia Football Cubie" id="img_croatia_football" name="img_croatia_football">
                <br>
                Croatia
                <br>
                <input type="checkbox" id="check_croatia_football" name="check_croatia_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Belgium_Football_Cubie.png" data-img="cubie-images/Cubie-Belgium_Football_Cubie.png"  onclick="openForm('form-belgium_football','check_belgium_football','check_owned_belgium_football', 'form-img-belgium_football', this)" alt="Belgium Football Cubie" id="img_belgium_football" name="img_belgium_football">
                <br>
                Belgium
                <br>
                <input type="checkbox" id="check_belgium_football" name="check_belgium_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Spain_Football_Cubie.png" data-img="cubie-images/Cubie-Spain_Football_Cubie.png"  onclick="openForm('form-spain_football','check_spain_football','check_owned_spain_football', 'form-img-spain_football', this)" alt="Spain Football Cubie" id="img_spain_football" name="img_spain_football">
                <br>
                Spain
                <br>
                <input type="checkbox" id="check_spain_football" name="check_spain_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Serbia_Football_Cubie.png" data-img="cubie-images/Cubie-Serbia_Football_Cubie.png"  onclick="openForm('form-serbia_football','check_serbia_football','check_owned_serbia_football', 'form-img-serbia_football', this)" alt="Serbia Football Cubie" id="img_serbia_football" name="img_serbia_football">
                <br>
                Serbia
                <br>
                <input type="checkbox" id="check_serbia_football" name="check_serbia_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Portugal_Football_Cubie.png" data-img="cubie-images/Cubie-Portugal_Football_Cubie.png"  onclick="openForm('form-portugal_football','check_portugal_football','check_owned_portugal_football', 'form-img-portugal_football', this)" alt="Portugal Football Cubie" id="img_portugal_football" name="img_portugal_football">
                <br>
                Portugal
                <br>
                <input type="checkbox" id="check_portugal_football" name="check_portugal_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Morocco_Football_Cubie.png" data-img="cubie-images/Cubie-Morocco_Football_Cubie.png"  onclick="openForm('form-morocco_football','check_morocco_football','check_owned_morocco_football', 'form-img-morocco_football', this)" alt="Morocco Football Cubie" id="img_morocco_football" name="img_morocco_football">
                <br>
                Morocco
                <br>
                <input type="checkbox" id="check_morocco_football" name="check_morocco_football" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Ghana_Football_Cubie.png" data-img="cubie-images/Cubie-Ghana_Football_Cubie.png"  onclick="openForm('form-ghana_football','check_ghana_football','check_owned_ghana_football', 'form-img-ghana_football', this)" alt="Ghana Football Cubie" id="img_ghana_football" name="img_ghana_football">
                <br>
                Ghana
                <br>
                <input type="checkbox" id="check_ghana_football" name="check_ghana_football" class="regular-checkbox" onchange="bgChange(this)">
            
        </tr>
    </table>
<br>
<table>
        <caption>Zodiac Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Scorpio_Cubie.png" data-img="cubie-images/Cubie-Scorpio_Cubie.png"  onclick="openForm('form-scorpio','check_scorpio','check_owned_scorpio', 'form-img-scorpio', this)" alt="Scorpio Cubie" id="img_scorpio" name="img_scorpio">
                <br>
                Scorpio
                <br>
                <input type="checkbox" id="check_scorpio" name="check_scorpio" class="regular-checkbox" onchange="bgChange(this)">
            
            <td>
                <img src="cubie-images/Cubie-Sagittarius_Cubie.png" data-img="cubie-images/Cubie-Sagittarius_Cubie.png"  onclick="openForm('form-sagittarius','check_sagittarius','check_owned_sagittarius', 'form-img-sagittarius', this)" alt="Sagittarius Cubie" id="img_sagittarius" name="img_sagittarius">
                <br>
                Sagittarius
                <br>
                <input type="checkbox" id="check_sagittarius" name="check_sagittarius" class="regular-checkbox" onchange="bgChange(this)">
</table>
    <!-- End of main cubie page 
        fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff 
        fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff 
        fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff 
        fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff 
        fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff fluff  -->
<br>

<br> 
<br> 
<br> 
<br> 
<br> 
<br> 
<br> 
<br> 
<br> 
<br> 
<br> 
