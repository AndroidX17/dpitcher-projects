<style> 
        main img {
            display: block; 
            float: center;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 0.5em;
            height: 100px;
            width: 100px;
        }

        table, th {
            border: 0px;
            text-align: center;
            color: #555;
        }

        td {
            border:0px;
            text-align: center;
            color: #555;
            width: 140px;
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
	        box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
	        padding: 9px;
	        border-radius: 3px;
	        display: inline-block;
	        position: relative;
        }

        .regular-checkbox:active, .regular-checkbox:checked:active {
	        box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
        }

        .regular-checkbox:checked {
	        background-color: #e9ecee;
	        border: 1px solid #adb8c0;
	        box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
	        color: #99a1a7;
        }

        .regular-checkbox:checked:after {
        	content: '\2714';
        	font-size: 14px;
	        position: absolute;
	        top: 0px;
        	left: 3px;
	        color: #99a1a7;
        }

        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position:absolute;
            top: 50%; 
            left: 50%;
            transform: translate(-50%, -50%);
            border: 3px solid #f1f1f1;
            z-index: 1;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
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
        .form-container .btn:hover, .open-button:hover {
            opacity: 1;
        }
</style>

<script> 

        function bgChange(checkbox){
            var td = checkbox.parentNode;
            if (checkbox.checked) {
                td.style.backgroundColor = "#A7ECF8"; 
            } else {
                td.style.backgroundColor = ""; 
            }
        }

        function openForm(formId, mainOwnedCheck, popOwnedCheck, formImg, img) {
            // Get the values of the checkboxes
            var originalOwnedCheck = document.getElementById(mainOwnedCheck);
            var formOwnedCheck = document.getElementById(popOwnedCheck);

            // Set the value of the checkbox in the form based on the value of the checkbox on the original page
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

</script>

<h1>Welcome To Your Cubiedex!</h1> 
<br>
<div class="form-popup" id="form-blue">
  <form action="/action_page.php" class="form-container">
    <img id="form-img-blue" src="">
    <table>
        <tr>
            <td>
                Owned 
            </td>
            <td>
                <input type="checkbox" id="check_owned_blue" name="check_owned_blue" class="regular-checkbox" onchange="updateOriginal('check_blue', 'check_owned_blue'), bgChange(check_blue)">
            </td>
        </tr>
        <tr>
            <td>
                Bought 
            </td>
            <td>
                <input type="checkbox" id="check_bought_blue" name="check_bought_blue" class="regular-checkbox" onchange="">
            </td>
        </tr>
        <tr>
            <td>
                Printed 
            </td>
            <td>
                <input type="checkbox" id="check_printed_blue" name="check_printed_blue" class="regular-checkbox" onchange="">
            </td>
        </tr> 
    </table>
    <br>
    <button type="button" class="btn cancel" onclick="closeForm('form-blue')">Close</button>
  </form> 
</div>

<div class="form-popup" id="form-green">
  <form action="/action_page.php" class="form-container">
    <img id="form-img-green" src="">
    <table>
        <tr>
            <td>
                Owned 
            </td>
            <td>
                <input type="checkbox" id="check_owned_green" name="check_owned_green" class="regular-checkbox" onchange="updateOriginal('check_green', 'check_owned_green'), bgChange(check_green)">
            </td>
        </tr>
        <tr>
            <td>
                Bought 
            </td>
            <td>
                <input type="checkbox" id="check_bought_green" name="check_bought_green" class="regular-checkbox" onchange="">
            </td>
        </tr>
        <tr>
            <td>
                Printed 
            </td>
            <td>
                <input type="checkbox" id="check_printed_green" name="check_printed_green" class="regular-checkbox" onchange="">
            </td>
        </tr> 
    </table>
    <br>
    <button type="button" class="btn cancel" onclick="closeForm('form-green')">Close</button>
  </form>
</div>

<div class="form-popup" id="form-yellow">
  <form action="/action_page.php" class="form-container">
    <img id="form-img-yellow" src="">
    <table>
        <tr>
            <td>
                Owned 
            </td>
            <td>
                <input type="checkbox" id="check_owned_yellow" name="check_owned_yellow" class="regular-checkbox" onchange="updateOriginal('check_yellow', 'check_owned_yellow'), bgChange(check_yellow)">
            </td>
        </tr>
        <tr>
            <td>
                Bought 
            </td>
            <td>
                <input type="checkbox" id="check_bought_yellow" name="check_bought_yellow" class="regular-checkbox" onchange="">
            </td>
        </tr>
        <tr>
            <td>
                Printed 
            </td>
            <td>
                <input type="checkbox" id="check_printed_yellow" name="check_printed_yellow" class="regular-checkbox" onchange="">
            </td>
        </tr> 
    </table>
    <br>
    <button type="button" class="btn cancel" onclick="closeForm('form-yellow')">Close</button>
  </form>
</div>

<div class="form-popup" id="form-red">
  <form action="/action_page.php" class="form-container">
    <img id="form-img-red" src="">
    <table>
        <tr>
            <td>
                Owned 
            </td>
            <td>
                <input type="checkbox" id="check_owned_red" name="check_owned_red" class="regular-checkbox" onchange="updateOriginal('check_red', 'check_owned_red'), bgChange(check_red)">
            </td>
        </tr>
        <tr>
            <td>
                Bought 
            </td>
            <td>
                <input type="checkbox" id="check_bought_red" name="check_bought_red" class="regular-checkbox" onchange="">
            </td>
        </tr>
        <tr>
            <td>
                Printed 
            </td>
            <td>
                <input type="checkbox" id="check_printed_red" name="check_printed_red" class="regular-checkbox" onchange="">
            </td>
        </tr> 
    </table>
    <br>
    <button type="button" class="btn cancel" onclick="closeForm('form-red')">Close</button>
  </form>
</div>

<div class="form-popup" id="form-purple">
  <form action="/action_page.php" class="form-container">
    <img id="form-img-purple" src="">
    <table>
        <tr>
            <td>
                Owned 
            </td>
            <td>
                <input type="checkbox" id="check_owned_purple" name="check_owned_purple" class="regular-checkbox" onchange="updateOriginal('check_purple', 'check_owned_purple'), bgChange(check_purple)">
            </td>
        </tr>
        <tr>
            <td>
                Bought 
            </td>
            <td>
                <input type="checkbox" id="check_bought_purple" name="check_bought_purple" class="regular-checkbox" onchange="">
            </td>
        </tr>
        <tr>
            <td>
                Printed 
            </td>
            <td>
                <input type="checkbox" id="check_printed_purple" name="check_printed_purple" class="regular-checkbox" onchange="">
            </td>
        </tr> 
    </table>
    <br>
    <button type="button" class="btn cancel" onclick="closeForm('form-purple')">Close</button>
  </form>
</div>

<div class="form-popup" id="form-white">
  <form action="/action_page.php" class="form-container">
    <img id="form-img-white" src="">
    <table>
        <tr>
            <td>
                Owned 
            </td>
            <td>
                <input type="checkbox" id="check_owned_white" name="check_owned_white" class="regular-checkbox" onchange="updateOriginal('check_white', 'check_owned_white'), bgChange(check_white)">
            </td>
        </tr>
        <tr>
            <td>
                Bought 
            </td>
            <td>
                <input type="checkbox" id="check_bought_white" name="check_bought_white" class="regular-checkbox" onchange="">
            </td>
        </tr>
        <tr>
            <td>
                Printed 
            </td>
            <td>
                <input type="checkbox" id="check_printed_white" name="check_printed_white" class="regular-checkbox" onchange="">
            </td>
        </tr> 
    </table>
    <br>
    <button type="button" class="btn cancel" onclick="closeForm('form-white')">Close</button>
  </form>
</div>

<div class="form-popup" id="form-og">
  <form action="/action_page.php" class="form-container">
    <img id="form-img-og" src="">
    <table>
        <tr>
            <td>
                Owned 
            </td>
            <td>
                <input type="checkbox" id="check_owned_og" name="check_owned_og" class="regular-checkbox" onchange="updateOriginal('check_og', 'check_owned_og'), bgChange(check_og)">
            </td>
        </tr>
        <tr>
            <td>
                Bought 
            </td>
            <td>
                <input type="checkbox" id="check_bought_og" name="check_bought_og" class="regular-checkbox" onchange="">
            </td>
        </tr>
        <tr>
            <td>
                Printed 
            </td>
            <td>
                <input type="checkbox" id="check_printed_og" name="check_printed_og" class="regular-checkbox" onchange="">
            </td>
        </tr> 
    </table>
    <br>
    <button type="button" class="btn cancel" onclick="closeForm('form-og')">Close</button>
  </form>
</div>

<div class="form-popup" id="form-bitcoin">
  <form action="/action_page.php" class="form-container">
    <img id="form-img-bitcoin" src="">
    <table>
        <tr>
            <td>
                Owned 
            </td>
            <td>
                <input type="checkbox" id="check_owned_bitcoin" name="check_owned_bitcoin" class="regular-checkbox" onchange="updateOriginal('check_bitcoin', 'check_owned_bitcoin'), bgChange(check_bitcoin)">
            </td>
        </tr>
        <tr>
            <td>
                Bought 
            </td>
            <td>
                <input type="checkbox" id="check_bought_bitcoin" name="check_bought_bitcoin" class="regular-checkbox" onchange="">
            </td>
        </tr>
        <tr>
            <td>
                Printed 
            </td>
            <td>
                <input type="checkbox" id="check_printed_bitcoin" name="check_printed_bitcoin" class="regular-checkbox" onchange="">
            </td>
        </tr> 
    </table>
    <br>
    <button type="button" class="btn cancel" onclick="closeForm('form-bitcoin')">Close</button>
  </form>
</div>

<div class="form-popup" id="form-pirate-captain">
  <form action="/action_page.php" class="form-container">
    <img id="form-img-pirate-captain" src="">
    <table>
        <tr>
            <td>
                Owned 
            </td>
            <td>
                <input type="checkbox" id="check_owned_pirate_captain" name="check_owned_pirate_captain" class="regular-checkbox" onchange="updateOriginal('check_pirate_captain', 'check_owned_pirate_captain'), bgChange(check_pirate_captain)">
            </td>
        </tr>
        <tr>
            <td>
                Bought 
            </td>
            <td>
                <input type="checkbox" id="check_bought_pirate_captain" name="check_bought_pirate_captain" class="regular-checkbox" onchange="">
            </td>
        </tr>
        <tr>
            <td>
                Printed 
            </td>
            <td>
                <input type="checkbox" id="check_printed_pirate_captain" name="check_printed_pirate_captain" class="regular-checkbox" onchange="">
            </td>
        </tr> 
    </table>
    <br>
    <button type="button" class="btn cancel" onclick="closeForm('form-pirate-captain')">Close</button>
  </form>
</div>


<br>
    <table>
        <caption>Colour Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Blue_Cubie.png" data-img="cubie-images/Cubie-Blue_Cubie.png" alt="Blue Cubie" id="img_blue" name="img_blue" onclick="openForm('form-blue','check_blue','check_owned_blue','form-img-blue', this)">
                <br>
                Blue
                <br>
                <input type="checkbox" id="check_blue" name="check_blue" class="regular-checkbox" onchange="bgChange(this)">
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
    <!--    <tr>
            <td><input type="checkbox" id="check_blue" name="check_blue"></td>
            <td><input type="checkbox" id="check_green" name="check_green"></td>
            <td><input type="checkbox" id="check_yellow" name="check_yellow"></td>
            <td><input type="checkbox" id="check_red" name="check_red"></td>
            <td><input type="checkbox" id="check_purple" name="check_purple"></td>
            <td><input type="checkbox" id="check_white" name="check_white"></td>
        </tr> -->
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
                <img src="cubie-images/Cubie-Pirate_Captain_Cubie.png" data-img="cubie-images/Cubie-Pirate_Captain_Cubie.png" alt="Pirate Captain Cubie" id="img_pirate_captain" name="img_pirate_captain" onclick="openForm('form-pirate-captain','check_pirate_captain','check_owned_pirate_captain', 'form-img-pirate-captain', this)">
                <br>
                Pirate Captain
                <br>
                <input type="checkbox" id="check_pirate_captain" name="check_pirate_captain" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Ethereum_Cubie.png" alt="Ethereum Cubie" id="img_ethereum" name="img_ethereum">
                <br>
                Ethereum
                <br>
                <input type="checkbox" id="check_ethereum" name="check_ethereum" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Shark_Cubie.png" alt="Shark Cubie" id="img_shark" name="img_shark">
                <br>
                Shark
                <br>
                <input type="checkbox" id="check_shark" name="check_shark" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Ice_Cubie.png" alt="Ice Cubie" id="img_ice" name="img_ice">
                <br>
                Ice
                <br>
                <input type="checkbox" id="check_ice" name="check_ice" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Pizza_Cubie.png" alt="Pizza Cubie" id="img_pizza" name="img_pizza">
                <br>
                Pizza
                <br>
                <input type="checkbox" id="check_pizza" name="check_pizza" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Summer_Cubie.png" alt="Summer Cubie" id="img_summer" name="img_summer">
                <br>
                Summer
                <br>
                <input type="checkbox" id="check_summer" name="check_summer" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_og" name="check_og"></td>
            <td><input type="checkbox" id="check_bitcoin" name="check_bitcoin"></td>
            <td><input type="checkbox" id="check_pirate_captain" name="check_pirate_captain"></td>
            <td><input type="checkbox" id="check_ethereum" name="check_ethereum"></td>
            <td><input type="checkbox" id="check_shark" name="check_shark"></td>
            <td><input type="checkbox" id="check_ice" name="check_ice"></td>
            <td><input type="checkbox" id="check_pizza" name="check_pizza"></td>
            <td><input type="checkbox" id="check_summer" name="check_summer"></td>
        </tr> -->
    </table>
<br>
    <table>
        <caption>Cat Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Snoozy_Cat_Cubie.png" alt="Snoozy Cubie" id="img_snoozy" name="img_snoozy">
                <br>
                Snoozy
                <br>
                <input type="checkbox" id="check_snoozy" name="check_snoozy" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Boba_Cat_Cubie.png" alt="Boba Cubie" id="img_boba" name="img_boba">
                <br>
                Boba
                <br>
                <input type="checkbox" id="check_boba" name="check_boba" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Ronda_Cat_Cubie.png" alt="Ronda Cubie" id="img_ronda" name="img_ronda">
                <br>
                Ronda
                <br>
                <input type="checkbox" id="check_ronda" name="check_ronda" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Patches_Cat_Cubie.png" alt="Patches Cubie" id="img_patches" name="name_patches">
                <br>
                Patches
                <br>
                <input type="checkbox" id="check_patches" name="check_patches" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Jett_Cat_Cubie.png" alt="Jett Cubie" id="img_jett" name="img_jett">
                <br>
                Jett
                <br>
                <input type="checkbox" id="check_jett" name="check_jett" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Tiger_Lily_Cat_Cubie.png" alt="Tiger Lily Cubie" id="img_tiger_lily" name="img_tiger_lily">
                <br>
                Tiger Lily
                <br>
                <input type="checkbox" id="check_tiger_lily" name="check_tiger_lily" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Softy_Cat_Cubie.png" alt="Softy Cubie" id="img_softy" name="img_softy">
                <br>
                Softy
                <br>
                <input type="checkbox" id="check_softy" name="check_softy" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Holly_Cat_Cubie.png" alt="Holly Cubie" id="img_holly" name="img_holly">
                <br>
                Holly
                <br>
                <input type="checkbox" id="check_holly" name="check_holly" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Missy_Cat_Cubie.png" alt="Missy Cubie" id="img_missy" name="img_missy">
                <br>
                Missy
                <br>
                <input type="checkbox" id="check_missy" name="check_missy" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_snoozy" name="check_snoozy"></td>
            <td><input type="checkbox" id="check_boba" name="check_boba"></td>
            <td><input type="checkbox" id="check_ronda" name="check_ronda"></td>
            <td><input type="checkbox" id="check_patches" name="check_patches"></td>
            <td><input type="checkbox" id="check_jett" name="check_jett"></td>
            <td><input type="checkbox" id="check_tiger_lily" name="check_tiger_lily"></td>
            <td><input type="checkbox" id="check_softy" name="check_softy"></td>
            <td><input type="checkbox" id="check_holly" name="check_holly"></td>
            <td><input type="checkbox" id="check_missy" name="check_missy"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Tiki Cubies - Thong Tribe</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Iki_Tiki_Cubie.png" alt="Iki Cubie" id="img_iki" name="img_iki">
                <br>
                Iki
                <br>
                <input type="checkbox" id="check_iki" name="check_iki" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Kuki_Tiki_Cubie.png" alt="Kuki Cubie" id="img_kuki" name="img_kuki">
                <br>
                Kuki
                <br>
                <input type="checkbox" id="check_kuki" name="check_kuki" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Kauka_Tiki_Cubie.png" alt="Kauka Cubie" id="img_kauka" name="img_kauka">
                <br>
                Kauka
                <br>
                <input type="checkbox" id="check_kauka" name="check_kauka" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Wawae_Tiki_Cubie.png" alt="Wawae Cubie" id="img_wawae" name="img_wawae">
                <br>
                Wawae
                <br>
                <input type="checkbox" id="check_wawae" name="check_wawae" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Ino_Tiki_Cubie.png" alt="Ino Cubie" id="img_ino" name="img_ino">
                <br>
                Ino
                <br>
                <input type="checkbox" id="check_ino" name="check_ino" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Ka_Pu_Tiki_Cubie.png" alt="Ka Pu Cubie" id="img_ka_pu" name="img_ka_pu">
                <br>
                Ka Pu
                <br>
                <input type="checkbox" id="check_ka_pu" name="check_ka_pu" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Enemi_Tiki_Cubie.png" alt="Enemi Cubie" id="img_enemi" name="img_enemi">
                <br>
                Enemi
                <br>
                <input type="checkbox" id="check_enemi" name="check_enemi" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Haohao_Tiki_Cubie.png" alt="Haohao Cubie" id="img_haohao" name="img_haohao">
                <br>
                Haohao
                <br>
                <input type="checkbox" id="check_haohao" name="check_haohao" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Hihiu_Tiki_Cubie.png" alt="Hihiu Cubie" id="img_hihiu" name="img_hihiu">
                <br>
                Hihiu
                <br>
                <input type="checkbox" id="check_hihiu" name="check_hihiu" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_iki" name="check_iki"></td>
            <td><input type="checkbox" id="check_kuki" name="check_kuki"></td>
            <td><input type="checkbox" id="check_kauka" name="check_kauka"></td>
            <td><input type="checkbox" id="check_wawae" name="check_wawae"></td>
            <td><input type="checkbox" id="check_ino" name="check_ino"></td>
            <td><input type="checkbox" id="check_ka_pu" name="check_ka_pu"></td>
            <td><input type="checkbox" id="check_enemi" name="check_enemi"></td>
            <td><input type="checkbox" id="check_haohao" name="check_haohao"></td>
            <td><input type="checkbox" id="check_hihiu" name="check_hihiu"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Tiki Cubies - White Skirt Tribe</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Niho_Tiki_Cubie.png" alt="Niho Cubie" id="img_niho" name="img_niho">
                <br>
                Niho
                <br>
                <input type="checkbox" id="check_niho" name="check_niho" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Olioli_Tiki_Cubie.png" alt="Olioli Cubie" id="img_olioli" name="img_olioli">
                <br>
                Olioli
                <br>
                <input type="checkbox" id="check_olioli" name="check_olioli" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Makeneki_Tiki_Cubie.png" alt="Makeneki Cubie" id="img_makeneki" name="img_makeneki">
                <br>
                Makeneki
                <br>
                <input type="checkbox" id="check_makeneki" name="check_makeneki" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Kopaa_Tiki_Cubie.png" alt="Kopaa Cubie" id="img_kopaa" name="img_kopaa">
                <br>
                Kopaa
                <br>
                <input type="checkbox" id="check_kopaa" name="check_kopaa" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Moo_Tiki_Cubie.png" alt="Mo'o Cubie" id="img_moo" name="img_moo">
                <br>
                Mo'o
                <br>
                <input type="checkbox" id="check_moo" name="check_moo" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Anu_Tiki_Cubie.png" alt="Anu Cubie" id="img_anu" name="img_anu">
                <br>
                Anu
                <br>
                <input type="checkbox" id="check_anu" name="check_anu" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Pohaku_Tiki_Cubie.png" alt="Pohaku Cubie" id="img_pohaku" name="img_pohaku">
                <br>
                Pohaku
                <br>
                <input type="checkbox" id="check_pohaku" name="check_pohaku" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Hamau_Tiki_Cubie.png" alt="Hamau Cubie" id="img_hamau" name="img_hamau">
                <br>
                Hamau
                <br>
                <input type="checkbox" id="check_hamau" name="check_hamau" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Metala_Tiki_Cubie.png" alt="Metala Cubie" id="img_metala" name="img_metala">
                <br>
                Metala
                <br>
                <input type="checkbox" id="check_metala" name="check_metala" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_niho" name="check_niho"></td>
            <td><input type="checkbox" id="check_olioli" name="check_olioli"></td>
            <td><input type="checkbox" id="check_makeneki" name="check_makeneki"></td>
            <td><input type="checkbox" id="check_kopaa" name="check_kopaa"></td>
            <td><input type="checkbox" id="check_moo" name="check_moo"></td>
            <td><input type="checkbox" id="check_anu" name="check_anu"></td>
            <td><input type="checkbox" id="check_pohaku" name="check_pohaku"></td>
            <td><input type="checkbox" id="check_hamau" name="check_hamau"></td>
            <td><input type="checkbox" id="check_metala" name="check_metala"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Tiki Cubies - Green Skirt Tribe</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Kaka_Tiki_Cubie.png" alt="Kaka Cubie" id="img_kaka" name="img_kaka">
                <br>
                Kaka
                <br>
                <input type="checkbox" id="check_kaka" name="check_kaka" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Paipika_Tiki_Cubie.png" alt="Paipika Cubie" id="img_paipika" name="img_paipika">
                <br>
                Paipika
                <br>
                <input type="checkbox" id="check_paipika" name="check_paipika" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Hookahi_Tiki_Cubie.png" alt="Hookahi Cubie" id="img_hookahi" name="img_hookahi">
                <br>
                Hookahi
                <br>
                <input type="checkbox" id="check_hookahi" name="check_hookahi" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Luna_Tiki_Cubie.png" alt="Luna Cubie" id="img_luna" name="img_luna">
                <br>
                Luna
                <br>
                <input type="checkbox" id="check_luna" name="check_luna" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Kaulana_Tiki_Cubie.png" alt="Kaulana Cubie" id="img_kaulana" name="img_kaulana">
                <br>
                Kaulana
                <br>
                <input type="checkbox" id="check_kaulana" name="check_kaulana" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Koa_Tiki_Cubie.png" alt="Koa Cubie" id="img_koa" name="img_koa">
                <br>
                Koa
                <br>
                <input type="checkbox" id="check_koa" name="check_koa" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Nani_Tiki_Cubie.png" alt="Nani Cubie" id="img_nani" name="img_nani">
                <br>
                Nani
                <br>
                <input type="checkbox" id="check_nani" name="check_nani" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Pila_Tiki_Cubie.png" alt="Pila Cubie" id="img_pila" name="img_pila">
                <br>
                Pila
                <br>
                <input type="checkbox" id="check_pila" name="check_pila" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Kelepona_Tiki_Cubie.png" alt="Kelepona Cubie" id="img_kelepona" name="img_kelepona">
                <br>
                Kelepona
                <br>
                <input type="checkbox" id="check_kelepona" name="check_kelepona" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_kaka" name="check_kaka"></td>
            <td><input type="checkbox" id="check_paipika" name="check_paipika"></td>
            <td><input type="checkbox" id="check_hookahi" name="check_hookahi"></td>
            <td><input type="checkbox" id="check_luna" name="check_luna"></td>
            <td><input type="checkbox" id="check_kaulana" name="check_kaulana"></td>
            <td><input type="checkbox" id="check_koa" name="check_koa"></td>
            <td><input type="checkbox" id="check_nani" name="check_nani"></td>
            <td><input type="checkbox" id="check_pila" name="check_pila"></td>
            <td><input type="checkbox" id="check_kelepona" name="check_kelepona"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Chinese New Year Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Ox_Cubie.png" alt="Ox Cubie" id="img_ox" name="img_ox">
                <br>
                Ox
                <br>
                <input type="checkbox" id="check_ox" name="check_ox" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Qipao_Cubie.png" alt="Qipao Cubie" id="img_qipao" name="img_qipao">
                <br>
                Qipao
                <br>
                <input type="checkbox" id="check_qipao" name="check_qipao" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Fire_Dragon_Cubie.png" alt="Fire Dragon Cubie" id="img_fire_dragon" name="img_fire_dragon">
                <br>
                Fire Dragon
                <br>
                <input type="checkbox" id="check_fire_dragon" name="check_fire_dragon" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Tiger_Cubie.png" alt="Tiger Cubie" id="img_tiger" name="img_tiger">
                <br>
                Tiger
                <br>
                <input type="checkbox" id="check_tiger" name="check_tiger" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Yellow_Dragon_Cubie.png" alt="Yellow Dragon Cubie" id="img_yellow_dragon" name="img_yellow_dragon">
                <br>
                Yellow Dragon
                <br>
                <input type="checkbox" id="check_yellow_dragon" name="check_yellow_dragon" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_ox" name="check_ox"></td>
            <td><input type="checkbox" id="check_qipao" name="check_qipao"></td>
            <td><input type="checkbox" id="check_fire_dragon" name="check_fire_dragon"></td>
            <td><input type="checkbox" id="check_tiger" name="check_tiger"></td>
            <td><input type="checkbox" id="check_yellow_dragon" name="check_yellow_dragon"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Hawaii Special Event Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Hula_Cubie.png" alt="Hula Cubie" id="img_hula" name="img_hula">
                <br>
                Hula
                <br>
                <input type="checkbox" id="check_hula" name="check_hula" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Surf_Cubie.png" alt="Surf Cubie" id="img_surf" name="img_surf">
                <br>
                Surf
                <br>
                <input type="checkbox" id="check_surf" name="check_surf" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Chill_Cubie.png" alt="Chill Cubie" id="img_chill" name="img_chill">
                <br>
                Chill
                <br>
                <input type="checkbox" id="check_chill" name="check_chill" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Sneaky_Seal_Cubie.png" alt="Sneaky Seal Cubie" id="img_sneaky_seal" name="img_sneaky_seal">
                <br>
                Sneaky Seal
                <br>
                <input type="checkbox" id="check_sneaky_seal" name="check_sneaky_seal" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Turtle_Cubie.png" alt="Turtle Cubie" id="img_turtle" name="img_turtle">
                <br>
                Turtle
                <br>
                <input type="checkbox" id="check_turtle" name="check_turtle" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_hula" name="check_hula"></td>
            <td><input type="checkbox" id="check_surf" name="check_surf"></td>
            <td><input type="checkbox" id="check_chill" name="check_chill"></td>
            <td><input type="checkbox" id="check_sneaky_seal" name="check_sneaky_seal"></td>
            <td><input type="checkbox" id="check_turtle" name="check_turtle"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Country Event Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Canada_Cubie.png" alt="Canada Cubie" id="img_canada" name="img_canada">
                <br>
                Canada
                <br>
                <input type="checkbox" id="check_canada" name="check_canada" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-USA_Cubie.png" alt="USA Cubie" id="img_usa" name="img_usa">
                <br>
                USA
                <br>
                <input type="checkbox" id="check_usa" name="check_usa" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-UK_Cubie.png" alt="UK Cubie" id="img_uk" name="img_uk">
                <br>
                UK
                <br>
                <input type="checkbox" id="check_uk" name="check_uk" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Bitcoin_Beach_Cubie.png" alt="Bitcoin Beach Cubie" id="img_bitcoin_beach" name="img_bitcoin_beach">
                <br>
                Bitcoin Beach 
                <br>
                <input type="checkbox" id="check_bitcoin_beach" name="check_bitcoin_beach" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_canada" name="check_canada"></td>
            <td><input type="checkbox" id="check_usa" name="check_usa"></td>
            <td><input type="checkbox" id="check_uk" name="check_uk"></td>
            <td><input type="checkbox" id="check_bitcoin_beach" name="check_bitcoin_beach"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Halloween Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Pumpkin_Cubie.png" alt="Pumpkin Cubie" id="img_pumpkin" name="img_pumpkin">
                <br>
                Pumpkin
                <br>
                <input type="checkbox" id="check_pumpkin" name="check_pumpkin" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Monster_Cubie.png" alt="Monster Cubie" id="img_monster" name="img_monster">
                <br>
                Monster
                <br>
                <input type="checkbox" id="check_monster" name="check_monster" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Mummy_Cubie.png" alt="Mummy Cubie" id="img_mummy" name="img_mummy">
                <br>
                Mummy
                <br>
                <input type="checkbox" id="check_mummy" name="check_mummy" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Vampire_Cubie.png" alt="Vampire Cubie" id="img_vampire" name="img_vampire">
                <br>
                Vampire
                <br>
                <input type="checkbox" id="check_vampire" name="check_vampire" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Witch_Cubie.png" alt="Witch Cubie" id="img_witch" name="img_witch">
                <br>
                Witch
                <br>
                <input type="checkbox" id="check_witch" name="check_witch" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Black_Cat_Cubie.png" alt="Black Cat Cubie" id="img_black_cat" name="img_black_cat">
                <br>
                Black Cat 
                <br>
                <input type="checkbox" id="check_black_cat" name="check_black_cat" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Zombie_Cubie.png" alt="Zombie Cubie" id="img_zombie" name="img_zombie">
                <br>
                Zombie
                <br>
                <input type="checkbox" id="check_zombie" name="check_zombie" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Skeleton_Cubie.png" alt="Skeleton Cubie" id="img_skeleton" name="img_skeleton">
                <br>
                Skeleton 
                <br>
                <input type="checkbox" id="check_skeleton" name="check_skeleton" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Ghost_Laura_Cubie.png" alt="Ghost Laura Cubie" id="img_ghost_laura" name="img_ghost_laura">
                <br>
                Ghost Laura 
                <br>
                <input type="checkbox" id="check_ghost_laura" name="check_ghost_laura" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Ghost_George_Cubie.png" alt="Ghost George Cubie" id="img_ghost_george" name="img_ghost_george">
                <br>
                Ghost George
                <br>
                <input type="checkbox" id="check_ghost_george" name="check_ghost_george" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_pumpkin" name="check_pumpkin"></td>
            <td><input type="checkbox" id="check_monster" name="check_monster"></td>
            <td><input type="checkbox" id="check_mummy" name="check_mummy"></td>
            <td><input type="checkbox" id="check_vampire" name="check_vampire"></td>
            <td><input type="checkbox" id="check_witch" name="check_witch"></td>
            <td><input type="checkbox" id="check_black_cat" name="check_black_cat"></td>
            <td><input type="checkbox" id="check_zombie" name="check_zombie"></td>
            <td><input type="checkbox" id="check_skeleton" name="check_skeleton"></td>
            <td><input type="checkbox" id="check_ghost_laura" name="check_ghost_laura"></td>
            <td><input type="checkbox" id="check_ghost_george" name="check_ghost_george"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Christmas Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Santa_Cubie.png" alt="Santa Cubie" id="img_santa" name="img_santa">
                <br>
                Santa 
                <br>
                <input type="checkbox" id="check_santa" name="check_santa" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Rudolph_Cubie.png" alt="Rudolph Cubie" id="img_rudolph" name="img_rudolph">
                <br>
                Rudolph 
                <br>
                <input type="checkbox" id="check_rudolph" name="check_rudolph" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Snowman_Cubie.png" alt="Snowman Cubie" id="img_snowman" name="img_snowman">
                <br>
                Snowman 
                <br>
                <input type="checkbox" id="check_snowman" name="check_snowman" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Elf_Cubie.png" alt="Elf Cubie" id="img_elf" name="img_elf">
                <br>
                Elf 
                <br>
                <input type="checkbox" id="check_elf" name="check_elf" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Gingerbread_Cubie.png" alt="Gingerbread Cubie" id="img_gingerbread" name="img_gingerbread">
                <br>
                Gingerbread 
                <br>
                <input type="checkbox" id="check_gingerbread" name="check_gingerbread" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Taylor_Cubie.png" alt="Taylor Cubie" id="img_taylor" name="img_taylor">
                <br>
                Taylor 
                <br>
                <input type="checkbox" id="check_taylor" name="check_taylor" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Lily_Cubie.png" alt="Lily Cubie" id="img_lily" name="img_lily">
                <br>
                Lily 
                <br>
                <input type="checkbox" id="check_lily" name="check_lily" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Skipper_Cubie.png" alt="Skipper Cubie" id="img_skipper" name="img_skipper">
                <br>
                Skipper 
                <br>
                <input type="checkbox" id="check_skipper" name="check_skipper" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Jacob_Cubie.png" alt="Jacob Cubie" id="img_jacob" name="img_jacob">
                <br>
                Jacob 
                <br>
                <input type="checkbox" id="check_jacob" name="check_jacob" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Nutcracker_Cubie.png" alt="Nutcracker Cubie" id="img_nutcracker" name="img_nutcracker">
                <br>
                Nutcracker 
                <br>
                <input type="checkbox" id="check_nutcracker" name="check_nutcracker" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_santa" name="check_santa"></td>
            <td><input type="checkbox" id="check_rudolph" name="check_rudolph"></td>
            <td><input type="checkbox" id="check_snowman" name="check_snowman"></td>
            <td><input type="checkbox" id="check_elf" name="check_elf"></td>
            <td><input type="checkbox" id="check_gingerbread" name="check_gingerbread"></td>
            <td><input type="checkbox" id="check_taylor" name="check_taylor"></td>
            <td><input type="checkbox" id="check_lily" name="check_lily"></td>
            <td><input type="checkbox" id="check_skipper" name="check_skipper"></td>
            <td><input type="checkbox" id="check_jacob" name="check_jacob"></td>
            <td><input type="checkbox" id="check_nutcracker" name="check_nutcracker"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Other Holiday Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Turkey_Cubie.png" alt="Turkey Cubie" id="img_turkey" name="img_turkey">
                <br>
                Turkey 
                <br>
                <input type="checkbox" id="check_turkey" name="check_turkey" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-NewYears_Cubie.png" alt="New Year 2021 Cubie" id="img_nye_2021" name="img_nye_2021">
                <br>
                NYE 2021 
                <br>
                <input type="checkbox" id="check_nye_2021" name="check_nye_2021" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Valentine_Cubie.png" alt="Valentine Cubie" id="img_valentine" name="img_valentine">
                <br>
                Valentine 
                <br>
                <input type="checkbox" id="check_valentine" name="check_valentine" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Leprechaun_Cubie.png" alt="Leprechaun Cubie" id="img_leprechaun" name="img_leprechaun">
                <br>
                Leprechaun 
                <br>
                <input type="checkbox" id="check_leprechaun" name="check_leprechaun" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Thanksgiving_Cubie.png" alt="Thanksgiving Cubie" id="img_thanksgiving" name="img_thanksgiving">
                <br>
                Thanksgiving 
                <br>
                <input type="checkbox" id="check_thanksgiving" name="check_thanksgiving" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-New_Year_2022_Cubie.png" alt="New Year 2022 Cubie" id="img_nye_2022" name="img_nye_2022">
                <br>
                NYE 2022 
                <br>
                <input type="checkbox" id="check_nye_2022" name="check_nye_2022" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_turkey" name="check_turkey"></td>
            <td><input type="checkbox" id="check_nye_2021" name="check_nye_2021"></td>
            <td><input type="checkbox" id="check_valentine" name="check_valentine"></td>
            <td><input type="checkbox" id="check_leprechaun" name="check_leprechaun"></td>
            <td><input type="checkbox" id="check_thanksgiving" name="check_thanksgiving"></td>
            <td><input type="checkbox" id="check_nye_2022" name="check_nye_2022"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Elemental Invasion Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Air_Cubie.png" alt="Air Cubie" id="img_air" name="img_air">
                <br>
                Air 
                <br>
                <input type="checkbox" id="check_air" name="check_air" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Water_Cubie.png" alt="Water Cubie" id="img_water" name="img_water">
                <br>
                Water 
                <br>
                <input type="checkbox" id="check_water" name="check_water" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Earth_Cubie.png" alt="Earth Cubie" id="img_earth" name="img_earth">
                <br>
                Earth 
                <br>
                <input type="checkbox" id="check_earth" name="check_earth" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Fire_Cubie.png" alt="Fire Cubie" id="img_fire" name="img_fire">
                <br>
                Fire 
                <br>
                <input type="checkbox" id="check_fire" name="check_fire" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_air" name="check_air"></td>
            <td><input type="checkbox" id="check_water" name="check_water"></td>
            <td><input type="checkbox" id="check_earth" name="check_earth"></td>
            <td><input type="checkbox" id="check_fire" name="check_fire"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Builder and Structure Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Sushi_Chef_Cubie.png" alt="Sushi Chef Cubie" id="img_sushi_chef" name="img_sushi_chef">
                <br>
                Sushi Chef 
                <br>
                <input type="checkbox" id="check_sushi_chef" name="check_sushi_chef" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Master_Sushi_Chef_Cubie.png" alt="Master Sushi Chef Cubie" id="img_master_sushi_chef" name="img_master_sushi_chef">
                <br>
                Master Sushi Chef
                <br>
                <input type="checkbox" id="check_master_sushi_chef" name="check_master_sushi_chef" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Construction_Cubie.png" alt="Construction Cubie" id="img_construction" name="img_construction">
                <br>
                Construction 
                <br>
                <input type="checkbox" id="check_construction" name="check_construction" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Foreman_Cubie.png" alt="Foreman Cubie" id="img_foreman" name="img_foreman">
                <br>
                Foreman 
                <br>
                <input type="checkbox" id="check_foreman" name="check_foreman" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-RNG_Cubie.png" alt="RNG Cubie" id="img_rng" name="img_rng">
                <br>
                RNG 
                <br>
                <input type="checkbox" id="check_rng" name="check_rng" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Tiki_Chief_Cubie.png" alt="Tiki Chief Cubie" id="img_tiki_chief" name="img_tiki_chief">
                <br>
                Tiki Chief 
                <br>
                <input type="checkbox" id="check_tiki_chief" name="check_tiki_chief" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Architect_Cubie.png" alt="Architect Cubie" id="img_architect" name="img_architect">
                <br>
                Architect
                <br>
                <input type="checkbox" id="check_architect" name="check_architect" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_sushi_chef" name="check_sushi_chef"></td>
            <td><input type="checkbox" id="check_master_sushi_chef" name="check_master_sushi_chef"></td>
            <td><input type="checkbox" id="check_construction" name="check_construction"></td>
            <td><input type="checkbox" id="check_foreman" name="check_foreman"></td>
            <td><input type="checkbox" id="check_rng" name="check_rng"></td>
            <td><input type="checkbox" id="check_tiki_chief" name="check_tiki_chief"></td>
            <td><input type="checkbox" id="check_architect" name="check_architect"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Cubie Air Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Marshaller_Cubie.png" alt="Marshaller Cubie" id="img_marshaller" name="img_marshaller">
                <br>
                Marshaller 
                <br>
                <input type="checkbox" id="check_marshaller" name="check_marshaller" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Cubie_Air_Jamie.png" alt="Jamie Cubie" id="img_jamie" name="img_jamie">
                <br>
                Jamie
                <br>
                <input type="checkbox" id="check_jamie" name="check_jamie" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Cubie_Air_Natalie.png" alt="Natalie Cubie" id="img_natalie" name="img_natalie">
                <br>
                Natalie
                <br>
                <input type="checkbox" id="check_natalie" name="check_natalie" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Cubie_Air_Angela.png" alt="Angela Cubie" id="img_angela" name="img_angela">
                <br>
                Angela
                <br>
                <input type="checkbox" id="check_angela" name="check_angela" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Cubie_Air_Laura.png" alt="Laura Cubie" id="img_laura" name="img_laura">
                <br>
                Laura
                <br>
                <input type="checkbox" id="check_laura" name="check_laura" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Cubie_Air_George.png" alt="George Cubie" id="img_george" name="img_george">
                <br>
                George
                <br>
                <input type="checkbox" id="check_george" name="check_george" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Wombat_Cubie.png" alt="Wombat Cubie" id="img_wombat" name="img_wombat">
                <br>
                Wombat
                <br>
                <input type="checkbox" id="check_wombat" name="check_wombat" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--   <tr>
            <td><input type="checkbox" id="check_marshaller" name="check_marshaller"></td>
            <td><input type="checkbox" id="check_jamie" name="check_jamie"></td>
            <td><input type="checkbox" id="check_natalie" name="check_natalie"></td>
            <td><input type="checkbox" id="check_angela" name="check_angela"></td>
            <td><input type="checkbox" id="check_laura" name="check_laura"></td>
            <td><input type="checkbox" id="check_george" name="check_george"></td>
            <td><input type="checkbox" id="check_wombat" name="check_wombat"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Partnership Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Doge_Cubie.png" alt="Doge Cubie" id="img_doge" name="img_doge">
                <br>
                Doge
                <br>
                <input type="checkbox" id="check_doge" name="check_doge" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Veriblock_Cubie.png" alt="Veriblock Cubie" id="img_veriblock" name="img_veriblock">
                <br>
                Veriblock
                <br>
                <input type="checkbox" id="check_veriblock" name="check_veriblock" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Suku_Cubie.png" alt="Suku Cubie" id="img_suku" name="img_suku">
                <br>
                Suku
                <br>
                <input type="checkbox" id="check_suku" name="check_suku" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Pat_Morita_Cubie.png" alt="Pat Morita Cubie" id="img_pat_morita" name="img_pat_morita">
                <br>
                Pat Morita
                <br>
                <input type="checkbox" id="check_pat_morita" name="check_pat_morita" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_doge" name="check_doge"></td>
            <td><input type="checkbox" id="check_veriblock" name="check_veriblock"></td>
            <td><input type="checkbox" id="check_suku" name="check_suku"></td>
            <td><input type="checkbox" id="check_pat_morita" name="check_pat_morita"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Football 2022 Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Ecuador_Football_Cubie.png" alt="Ecuador Football Cubie" id="img_ecuador_football" name="img_ecuador_football">
                <br>
                Ecuador
                <br>
                <input type="checkbox" id="check_ecuador_football" name="check_ecuador_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Argentina_Football_Cubie.png" alt="Argentina Football Cubie" id="img_argentina_football" name="img_argentina_football">
                <br>
                Argentina
                <br>
                <input type="checkbox" id="check_argentina_football" name="check_argentina_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Australia_Football_Cubie.png" alt="Australia Football Cubie" id="img_australia_football" name="img_australia_football">
                <br>
                Australia
                <br>
                <input type="checkbox" id="check_australia_football" name="check_australia_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Iran_Football_Cubie.png" alt="Iran Football Cubie" id="img_iran_football" name="img_iran_football">
                <br>
                Iran
                <br>
                <input type="checkbox" id="check_iran_football" name="check_iran_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-France_Football_Cubie.png" alt="France Football Cubie" id="img_france_football" name="img_france_football">
                <br>
                France
                <br>
                <input type="checkbox" id="check_france_football" name="check_france_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Saudi_Arabia_Football_Cubie.png" alt="Saudi Arabia Football Cubie" id="img_saudi_arabia_football" name="img_saudi_arabia_football">
                <br>
                Saudi Arabia
                <br>
                <input type="checkbox" id="check_saudi_arabia_football" name="check_saudi_arabia_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Qatar_Football_Cubie.png" alt="Qatar Football Cubie" id="img_qatar_football" name="img_qatar_football">
                <br>
                Qatar
                <br>
                <input type="checkbox" id="check_qatar_football" name="check_qatar_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Cameroon_Football_Cubie.png" alt="Cameroon Football Cubie" id="img_cameroon_football" name="img_cameroon_football">
                <br>
                Cameroon
                <br>
                <input type="checkbox" id="check_cameroon_football" name="check_cameroon_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_ecuador_football" name="check_ecuador_football"></td>
            <td><input type="checkbox" id="check_argentina_football" name="check_argentina_football"></td>
            <td><input type="checkbox" id="check_australia_football" name="check_australia_football"></td>
            <td><input type="checkbox" id="check_iran_football" name="check_iran_football"></td>
            <td><input type="checkbox" id="check_france_football" name="check_france_football"></td>
            <td><input type="checkbox" id="check_saudi_arabia_football" name="check_saudi_arabia_football"></td>
            <td><input type="checkbox" id="check_qatar_football" name="check_qatar_football"></td>
            <td><input type="checkbox" id="check_cameroon_football" name="check_cameroon_football"></td>
        </tr> -->
        <tr>
            <td>
                <img src="cubie-images/Cubie-Brazil_Football_Cubie.png" alt="Brazil Football Cubie" id="img_brazil_football" name="img_brazil_football">
                <br>
                Brazil
                <br>
                <input type="checkbox" id="check_brazil_football" name="check_brazil_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Switzerland_Football_Cubie.png" alt="Switzerland Football Cubie" id="img_switzerland_football" name="img_switzerland_football">
                <br>
                Switzerland
                <br>
                <input type="checkbox" id="check_switzerland_football" name="check_switzerland_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Denmark_Football_Cubie.png" alt="Denmark Football Cubie" id="img_denmark_football" name="img_denmark_football">
                <br>
                Denmark
                <br>
                <input type="checkbox" id="check_denmark_football" name="check_denmark_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-England_Football_Cubie.png" alt="England Football Cubie" id="img_england_football" name="img_england_football">
                <br>
                England
                <br>
                <input type="checkbox" id="check_england_football" name="check_england_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Netherlands_Football_Cubie.png" alt="Netherlands Football Cubie" id="img_netherlands_football" name="img_netherlands_football">
                <br>
                Netherlands
                <br>
                <input type="checkbox" id="check_netherlands_football" name="check_netherlands_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Poland_Football_Cubie.png" alt="Poland Football Cubie" id="img_poland_footbal" name="img_poland_football">
                <br>
                Poland
                <br>
                <input type="checkbox" id="check_poland_football" name="check_poland_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-United_States_Football_Cubie.png" alt="United States Football Cubie" id="img_united_states_football" name="img_united_states_football">
                <br>
                United States
                <br>
                <input type="checkbox" id="check_united_states_football" name="check_united_states_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Wales_Football_Cubie.png" alt="Wales Football Cubie" id="img_wales_football" name="img_wales_football">
                <br>
                Wales
                <br>
                <input type="checkbox" id="check_wales_football" name="check_wales_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_brazil_football" name="check_brazil_football"></td>
            <td><input type="checkbox" id="check_switzerland_football" name="check_switzerland_football"></td>
            <td><input type="checkbox" id="check_denmark_football" name="check_denmark_football"></td>
            <td><input type="checkbox" id="check_england_football" name="check_england_football"></td>
            <td><input type="checkbox" id="check_netherlands_football" name="check_netherlands_football"></td>
            <td><input type="checkbox" id="check_poland_football" name="check_poland_football"></td>
            <td><input type="checkbox" id="check_united_states_football" name="check_united_states_football"></td>
            <td><input type="checkbox" id="check_wales_football" name="check_wales_football"></td>
        </tr> -->
        <tr>
            <td>
                <img src="cubie-images/Cubie-Costa_Rica_Football_Cubie.png" alt="Costa Rica Football Cubie" id="img_costa_rica_football" name="img_costa_rica_football">
                <br>
                Costa Rica
                <br>
                <input type="checkbox" id="check_costa_rica_football" name="check_costa_rica_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Japan_Football_Cubie.png" alt="Japan Football Cubie" id="img_japan_football" name="img_japan_football">
                <br>
                Japan
                <br>
                <input type="checkbox" id="check_japan_football" name="check_japan_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Canada_Football_Cubie.png" alt="Canada Football Cubie" id="img_canada_football" name="img_canada_football">
                <br>
                Canada
                <br>
                <input type="checkbox" id="check_canada_football" name="check_canada_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Senegal_Football_Cubie.png" alt="Senegal Football Cubie" id="img_senegal_football" name="img_senegal_football">
                <br>
                Senegal
                <br>
                <input type="checkbox" id="check_senegal_football" name="check_senegal_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Mexico_Football_Cubie.png" alt="Mexico Football Cubie" id="img_mexico_football" name="img_mexico_football">
                <br>
                Mexico
                <br>
                <input type="checkbox" id="check_mexico_football" name="check_mexico_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Tunisia_Football_Cubie.png" alt="Tunisia Football Cubie" id="img_tunisia_football" name="img_tunisia_football">
                <br>
                Tunisia
                <br>
                <input type="checkbox" id="check_tunisia_football" name="check_tunisia_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-South_Korea_Football_Cubie.png" alt="South Korea Football Cubie" id="img_south_korea_football" name="img_south_korea_football">
                <br>
                South Korea
                <br>
                <input type="checkbox" id="check_south_korea_football" name="check_south_korea_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Germany_Football_Cubie.png" alt="Germany Football Cubie" id="img_germany_football" name="img_germany_football">
                <br>
                Germany
                <br>
                <input type="checkbox" id="check_germany_football" name="check_germany_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_costa_rica_football" name="check_costa_rica_football"></td>
            <td><input type="checkbox" id="check_japan_football" name="check_japan_football"></td>
            <td><input type="checkbox" id="check_canada_football" name="check_canada_football"></td>
            <td><input type="checkbox" id="check_senegal_football" name="check_senegal_football"></td>
            <td><input type="checkbox" id="check_mexico_football" name="check_mexico_football"></td>
            <td><input type="checkbox" id="check_tunisia_football" name="check_tunisia_football"></td>
            <td><input type="checkbox" id="check_south_korea_football" name="check_south_korea_football"></td>
            <td><input type="checkbox" id="check_germany_football" name="check_germany_football"></td>
        </tr> -->
        <tr>
            <td>
                <img src="cubie-images/Cubie-Uruguay_Football_Cubie.png" alt="Uruguay Football Cubie" id="img_uruguay_football" name="img_uruguay_football">
                <br>
                Uruguay
                <br>
                <input type="checkbox" id="check_uruguay_football" name="check_uruguay_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Croatia_Football_Cubie.png" alt="Croatia Football Cubie" id="img_croatia_football" name="img_croatia_football">
                <br>
                Croatia
                <br>
                <input type="checkbox" id="check_croatia_football" name="check_croatia_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Belgium_Football_Cubie.png" alt="Belgium Football Cubie" id="img_belgium_football" name="img_belgium_football">
                <br>
                Belgium
                <br>
                <input type="checkbox" id="check_belgium_football" name="check_belgium_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Spain_Football_Cubie.png" alt="Spain Football Cubie" id="img_spain_football" name="img_spain_football">
                <br>
                Spain
                <br>
                <input type="checkbox" id="check_spain_football" name="check_spain_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Serbia_Football_Cubie.png" alt="Serbia Football Cubie" id="img_serbia_football" name="img_serbia_football">
                <br>
                Serbia
                <br>
                <input type="checkbox" id="check_serbia_football" name="check_serbia_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Portugal_Football_Cubie.png" alt="Portugal Football Cubie" id="img_portugal_football" name="img_portugal_football">
                <br>
                Portugal
                <br>
                <input type="checkbox" id="check_portugal_football" name="check_portugal_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Morocco_Football_Cubie.png" alt="Morocco Football Cubie" id="img_morocco_football" name="img_morocco_football">
                <br>
                Morocco
                <br>
                <input type="checkbox" id="check_morocco_football" name="check_morocco_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Ghana_Football_Cubie.png" alt="Ghana Football Cubie" id="img_ghana_football" name="img_ghana_football">
                <br>
                Ghana
                <br>
                <input type="checkbox" id="check_ghana_football" name="check_ghana_football" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    <!--    <tr>
            <td><input type="checkbox" id="check_uruguay_football" name="check_uruguay_football"></td>
            <td><input type="checkbox" id="check_croatia_football" name="check_croatia_football"></td>
            <td><input type="checkbox" id="check_belgium_football" name="check_belgium_football"></td>
            <td><input type="checkbox" id="check_spain_football" name="check_spain_football"></td>
            <td><input type="checkbox" id="check_serbia_football" name="check_serbia_football"></td>
            <td><input type="checkbox" id="check_portugal_football" name="check_portugal_football"></td>
            <td><input type="checkbox" id="check_morocco_football" name="check_morocco_football"></td>
            <td><input type="checkbox" id="check_ghana_football" name="check_ghana_football"></td>
        </tr> -->
    </table>
<br>
<table>
        <caption>Zodiac Cubies</caption>
        <tr>
            <td>
                <img src="cubie-images/Cubie-Scorpio_Cubie.png" alt="Scorpio Cubie" id="img_scorpio" name="img_scorpio">
                <br>
                Scorpio
                <br>
                <input type="checkbox" id="check_scorpio" name="check_scorpio" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-images/Cubie-Sagittarius_Cubie.png" alt="Sagittarius Cubie" id="img_sagittarius" name="img_sagittarius">
                <br>
                Sagittarius
                <br>
                <input type="checkbox" id="check_sagittarius" name="check_sagittarius" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    </table>
    <!--
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
