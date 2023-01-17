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
            margin-bottom: 22px;
            height: 100px;
            width: 120px;
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

        tr {
            display:flex; 
            flex-wrap: wrap;
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
            /*	content: '\2714';
        	font-size: 14px;
	        position: absolute;
	        top: 0px;
        	left: 3px; */
	        color: #3BDBF6;
        }

/*        .regular-checkbox {
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
        } */
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

        var alltermsbp = ["green_bp", "yellow_bp", "red_bp", "purple_bp", "white_bp", "og_bp", "bitcoin_bp", "pirate_captain_bp", "ethereum_bp", "shark_bp", "ice_bp", "pizza_bp", "summer_bp", "cat_bp", "tiki_warrior_bp", "world_cup_bp", "ox_bp", "qipao_bp", "fire_dragon_bp", "tiger_bp", "yellow_dragon_bp", "hula_bp", "surf_bp", "chill_bp", "sneaky_seal_bp", "turtle_bp", "canada_bp", "usa_bp", "uk_bp", "bitcoin_beach_bp", "pumpkin_bp", "monster_bp", "mummy_bp", "vampire_bp", "witch_bp", "black_cat_bp", "zombie_bp", "skeleton_bp", "ghost_bp", "santa_bp", "rudolph_bp", "snowman_bp", "elf_bp", "gingerbread_bp", "ugly_sweater_bp", "nutcracker_bp", "valentine_bp", "leprechaun_bp", "thanksgiving_bp", "nye_2022_bp", "air_bp", "water_bp", "earth_bp", "fire_bp", "sushi_chef_bp", "master_sushi_chef_bp", "construction_bp", "foreman_bp", "rng_bp", "tiki_chief_bp", "architect_bp", "marshaller_bp", "flight_attendant_bp", "pilot_bp", "wombat_bp", "doge_bp", "veriblock_bp", "suku_bp", "pat_morita_bp"];

</script>

<h1>Welcome To Your Blueprint Emporium!</h1> 
<br>
<br>
    <table>
        <caption>Colour Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-Green_Cubie_Blueprint.png" alt="Green Cubie" id="img_green_bp" name="img_green_bp">
                <br>
                Green
                <br>
                <input type="checkbox" id="check_green_bp" name="check_green_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Yellow_Cubie_Blueprint.png" alt="Yellow Cubie" id="img_yellow_bp" name="img_yellow_bp">
                <br>
                Yellow
                <br>
                <input type="checkbox" id="check_yellow_bp" name="check_yellow_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Red_Cubie_Blueprint.png" alt="Red Cubie" id="img_red_bp" name="img_red_bp">
                <br>
                Red
                <br>
                <input type="checkbox" id="check_red_bp" name="check_red_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Purple_Cubie_Blueprint.png" alt="Purple Cubie" id="img_purple_bp" name="img_purple_bp">
                <br>
                Purple
                <br>
                <input type="checkbox" id="check_purple_bp" name="check_purple_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-White_Cubie_Blueprint.png" alt="White Cubie" id="img_white_bp" name="img_white_bp">
                <br>
                White
                <br>
                <input type="checkbox" id="check_white_bp" name="check_white_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    </table>
<br> 
<table>
        <caption>Shop Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-OG_Cubie_Blueprint.png" alt="OG Cubie" id="img_og_bp" name="img_og_bp">
                <br>
                OG
                <br>
                <input type="checkbox" id="check_og_bp" name="check_og_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Bitcoin_Cubie_Blueprint.png" alt="Bitcoin Cubie" id="img_bitcoin_bp" name="img_bitcoin_bp">
                <br>
                Bitcoin
                <br>
                <input type="checkbox" id="check_bitcoin_bp" name="check_bitcoin_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Pirate_Captain_Cubie_Blueprint.png" alt="Pirate Captain Cubie" id="img_pirate_captain_bp" name="img_pirate_captain_bp">
                <br>
                Pirate Captain
                <br>
                <input type="checkbox" id="check_pirate_captain_bp" name="check_pirate_captain" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Ethereum_Cubie_Blueprint.png" alt="Ethereum Cubie" id="img_ethereum_bp" name="img_ethereum_bp">
                <br>
                Ethereum
                <br>
                <input type="checkbox" id="check_ethereum_bp" name="check_ethereum_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Shark_Cubie_Blueprint.png" alt="Shark Cubie" id="img_shark_bp" name="img_shark_bp">
                <br>
                Shark
                <br>
                <input type="checkbox" id="check_shark_bp" name="check_shark_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Ice_Cubie_Blueprint.png" alt="Ice Cubie" id="img_ice_bp" name="img_ice_bp">
                <br>
                Ice
                <br>
                <input type="checkbox" id="check_ice_bp" name="check_ice_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Pizza_Cubie_Blueprint.png" alt="Pizza Cubie" id="img_pizza_bp" name="img_pizza_bp">
                <br>
                Pizza
                <br>
                <input type="checkbox" id="check_pizza_bp" name="check_pizza_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Summer_Cubie_Blueprint.png" alt="Summer Cubie" id="img_summer_bp" name="img_summer_bp">
                <br>
                Summer
                <br>
                <input type="checkbox" id="check_summer_bp" name="check_summer_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Cat_Cubie_Blueprint.png" alt="Cat Cubie" id="img_cat_bp" name="img_cat_bp">
                <br>
                Cat
                <br>
                <input type="checkbox" id="check_cat_bp" name="check_cat_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Tiki_Warrior_Cubie_Blueprint.png" alt="Tiki Warrior Cubie" id="img_tiki_warrior_bp" name="img_tiki_warrior_bp">
                <br>
                Tiki Warrior
                <br>
                <input type="checkbox" id="check_tiki_warrior_bp" name="check_tiki_warrior_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-World_Cup_Cubie_Blueprint.png" alt="World Cup Cubie" id="img_world_cup_bp" name="img_world_cup_bp">
                <br>
                World Cup
                <br>
                <input type="checkbox" id="check_world_cup_bp" name="check_world_cup_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>
    </table>
<br>
<table>
        <caption>Chinese New Year Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-Ox_Cubie_Blueprint.png" alt="Ox Cubie" id="img_ox_bp" name="img_ox_bp">
                <br>
                Ox
                <br>
                <input type="checkbox" id="check_ox_bp" name="check_ox_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Qipao_Cubie_Blueprint.png" alt="Qipao Cubie" id="img_qipao_bp" name="img_qipao_bp">
                <br>
                Qipao
                <br>
                <input type="checkbox" id="check_qipao_bp" name="check_qipao_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Fire_Dragon_Cubie_Blueprint.png" alt="Fire Dragon Cubie" id="img_fire_dragon_bp" name="img_fire_dragon_bp">
                <br>
                Fire Dragon
                <br>
                <input type="checkbox" id="check_fire_dragon_bp" name="check_fire_dragon_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Tiger_Cubie_Blueprint.png" alt="Tiger Cubie" id="img_tiger_bp" name="img_tiger_bp">
                <br>
                Tiger
                <br>
                <input type="checkbox" id="check_tiger_bp" name="check_tiger_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Yellow_Dragon_Cubie_Blueprint.png" alt="Yellow Dragon Cubie" id="img_yellow_dragon_bp" name="img_yellow_dragon_bp">
                <br>
                Yellow Dragon
                <br>
                <input type="checkbox" id="check_yellow_dragon_bp" name="check_yellow_dragon_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>

    </table>
<br>
<table>
        <caption>Hawaii Special Event Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-Hula_Cubie_Blueprint.png" alt="Hula Cubie" id="img_hula_bp" name="img_hula_bp">
                <br>
                Hula
                <br>
                <input type="checkbox" id="check_hula_bp" name="check_hula_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Surf_Cubie_Blueprint.png" alt="Surf Cubie" id="img_surf_bp" name="img_surf_bp">
                <br>
                Surf
                <br>
                <input type="checkbox" id="check_surf_bp" name="check_surf_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Chill_Cubie_Blueprint.png" alt="Chill Cubie" id="img_chill_bp" name="img_chill_bp">
                <br>
                Chill
                <br>
                <input type="checkbox" id="check_chill_bp" name="check_chill_bp" class="regular-checkbox" onchange="bgChange(this)"> 
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Sneaky_Seal_Cubie_Blueprint.png" alt="Sneaky Seal Cubie" id="img_sneaky_seal_bp" name="img_sneaky_seal_bp">
                <br>
                Sneaky Seal
                <br>
                <input type="checkbox" id="check_sneaky_seal_bp" name="check_sneaky_seal_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Turtle_Cubie_Blueprint.png" alt="Turtle Cubie" id="img_turtle_bp" name="img_turtle_bp">
                <br>
                Turtle
                <br>
                <input type="checkbox" id="check_turtle_bp" name="check_turtle_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>

    </table>
<br>
<table>
        <caption>Country Event Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-Canada_Cubie_Blueprint.png" alt="Canada Cubie" id="img_canada_bp" name="img_canada_bp">
                <br>
                Canada
                <br>
                <input type="checkbox" id="check_canada_bp" name="check_canada_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-USA_Cubie_Blueprint.png" alt="USA Cubie" id="img_usa_bp" name="img_usa_bp">
                <br>
                USA
                <br>
                <input type="checkbox" id="check_usa_bp" name="check_usa_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-UK_Cubie_Blueprint.png" alt="UK Cubie" id="img_uk_bp" name="img_uk_bp">
                <br>
                UK
                <br>
                <input type="checkbox" id="check_uk_bp" name="check_uk_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Bitcoin_Beach_Cubie_Blueprint.png" alt="Bitcoin Beach Cubie" id="img_bitcoin_beach_bp" name="img_bitcoin_beach_bp">
                <br>
                Bitcoin Beach
                <br>
                <input type="checkbox" id="check_bitcoin_beach_bp" name="check_bitcoin_beach_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr> 

    </table>
<br>
<table>
        <caption>Halloween Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-Pumpkin_Cubie_Blueprint.png" alt="Pumpkin Cubie" id="img_pumpkin_bp" name="img_pumpkin_bp">
                <br>
                Pumpkin
                <br>
                <input type="checkbox" id="check_pumpkin_bp" name="check_pumpkin_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Monster_Cubie_Blueprint.png" alt="Monster Cubie" id="img_monster_bp" name="img_monster_bp">
                <br>
                Monster
                <br>
                <input type="checkbox" id="check_monster_bp" name="check_monster_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Mummy_Cubie_Blueprint.png" alt="Mummy Cubie" id="img_mummy_bp" name="img_mummy_bp">
                <br>
                Mummy
                <br>
                <input type="checkbox" id="check_mummy_bp" name="check_mummy_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Vampire_Cubie_Blueprint.png" alt="Vampire Cubie" id="img_vampire_bp" name="img_vampire_bp">
                <br>
                Vampire
                <br>
                <input type="checkbox" id="check_vampire_bp" name="check_vampire_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Witch_Cubie_Blueprint.png" alt="Witch Cubie" id="img_witch_bp" name="img_witch_bp">
                <br>
                Witch
                <br>
                <input type="checkbox" id="check_witch_bp" name="check_witch_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Black_Cat_Cubie_Blueprint.png" alt="Black Cat Cubie" id="img_black_cat_bp" name="img_black_cat_bp">
                <br>
                Black Cat
                <br>
                <input type="checkbox" id="check_black_cat_bp" name="check_black_cat_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Zombie_Cubie_Blueprint.png" alt="Zombie Cubie" id="img_zombie_bp" name="img_zombie_bp">
                <br>
                Zombie
                <br>
                <input type="checkbox" id="check_zombie_bp" name="check_zombie_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Skeleton_Cubie_Blueprint.png" alt="Skeleton Cubie" id="img_skeleton_bp" name="img_skeleton_bp">
                <br>
                Skeleton
                <br>
                <input type="checkbox" id="check_skeleton_bp" name="check_skeleton_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Ghost_Cubie_Blueprint.png" alt="Ghost Cubie" id="img_ghost_bp" name="img_ghost_bp">
                <br>
                Ghost
                <br>
                <input type="checkbox" id="check_ghost_bp" name="check_ghost_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>

    </table>
<br>
<table>
        <caption>Christmas Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-Santa_Cubie_Blueprint.png" alt="Santa Cubie" id="img_santa_bp" name="img_santa_bp">
                <br>
                Santa
                <br>
                <input type="checkbox" id="check_santa_bp" name="check_santa_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Rudolph_Cubie_Blueprint.png" alt="Rudolph Cubie" id="img_rudolph_bp" name="img_rudolph_bp">
                <br>
                Rudolph
                <br>
                <input type="checkbox" id="check_rudolph_bp" name="check_rudolph_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Snowman_Cubie_Blueprint.png" alt="Snowman Cubie" id="img_snowman_bp" name="img_snowman_bp">
                <br>
                Snowman
                <br>
                <input type="checkbox" id="check_snowman_bp" name="check_snowman_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Elf_Cubie_Blueprint.png" alt="Elf Cubie" id="img_elf_bp" name="img_elf_bp">
                <br>
                Elf
                <br>
                <input type="checkbox" id="check_elf_bp" name="check_elf_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Gingerbread_Cubie_Blueprint.png" alt="Gingerbread Cubie" id="img_gingerbread_bp" name="img_gingerbread_bp">
                <br>
                Gingerbread
                <br>
                <input type="checkbox" id="check_gingerbread_bp" name="check_gingerbread_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Ugly_Sweater_Cubie_Blueprint.png" alt="Ugly Sweater Cubie" id="img_ugly_sweater_bp" name="img_ugly_sweater_bp">
                <br>
                Ugly Sweater
                <br>
                <input type="checkbox" id="check_ugly_sweater_bp" name="check_ugly_sweater_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Nutcracker_Cubie_Blueprint.png" alt="Nutcracker Cubie" id="img_nutcracker_bp" name="img_nutcracker_bp">
                <br>
                Nutcracker
                <br>
                <input type="checkbox" id="check_nutcracker_bp" name="check_nutcracker_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>

    </table>
<br>
<table>
        <caption>Other Holiday Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-Valentine_Cubie_Blueprint.png" alt="Valentine Cubie" id="img_valentine_bp" name="img_valentine_bp">
                <br>
                Valentine
                <br>
                <input type="checkbox" id="check_valentine_bp" name="check_valentine_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Leprechaun_Cubie_Blueprint.png" alt="Leprechaun Cubie" id="img_leprechaun_bp" name="img_leprechaun_bp">
                <br>
                Leprechaun
                <br><input type="checkbox" id="check_leprechaun_bp" name="check_leprechaun_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Thanksgiving_Cubie_Blueprint.png" alt="Thanksgiving Cubie" id="img_thanksgiving_bp" name="img_thanksgiving_bp">
                <br>
                Thanksgiving
                <br>
                <input type="checkbox" id="check_thanksgiving_bp" name="check_thanksgiving_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-New_Year_2022_Cubie_Blueprint.png" alt="New Year 2022 Cubie" id="img_nye_2022_bp" name="img_nye_2022_bp">
                <br>
                NYE 2022
                <br>
                <input type="checkbox" id="check_nye_2022_bp" name="check_nye_2022_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>

    </table>
<br>
<table>
        <caption>Elemental Invasion Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-Air_Cubie_Blueprint.png" alt="Air Cubie" id="img_air_bp" name="img_air_bp">
                <br>
                Air
                <br>
                <input type="checkbox" id="check_air_bp" name="check_air_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Water_Cubie_Blueprint.png" alt="Water Cubie" id="img_water_bp" name="img_water_bp">
                <br>
                Water
                <br>
                <input type="checkbox" id="check_water_bp" name="check_water_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Earth_Cubie_Blueprint.png" alt="Earth Cubie" id="img_earth_bp" name="img_earth_bp">
                <br>
                Earth
                <br>
                <input type="checkbox" id="check_earth_bp" name="check_earth_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Fire_Cubie_Blueprint.png" alt="Fire Cubie" id="img_fire_bp" name="img_fire_bp">
                <br>
                Fire
                <br>
                <input type="checkbox" id="check_fire_bp" name="check_fire_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>

    </table>
<br>
<table>
        <caption>Builder and Structure Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-Sushi_Chef_Cubie_Blueprint.png" alt="Sushi Chef Cubie" id="img_sushi_chef_bp" name="img_sushi_chef_bp">
                <br>
                Sushi Chef
                <br>
                <input type="checkbox" id="check_sushi_chef_bp" name="check_sushi_chef_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Master_Sushi_Chef_Cubie_Blueprint.png" alt="Master Sushi Chef Cubie" id="img_master_sushi_chef_bp" name="img_master_sushi_chef_bp">
                <br>
                Master Sushi Chef
                <br>
                <input type="checkbox" id="check_master_sushi_chef_bp" name="check_master_sushi_chef_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Construction_Cubie_Blueprint.png" alt="Construction Cubie" id="img_construction_bp" name="img_construction_bp">
                <br>
                Construction
                <br>
                <input type="checkbox" id="check_construction_bp" name="check_construction_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Foreman_Cubie_Blueprint.png" alt="Foreman Cubie" id="img_foreman_bp" name="img_foreman_bp">
                <br>
                Foreman
                <br>
                <input type="checkbox" id="check_foreman_bp" name="check_foreman_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-RNG_Cubie_Blueprint.png" alt="RNG Cubie" id="img_rng_bp" name="img_rng_bp">
                <br>
                RNG
                <br>
                <input type="checkbox" id="check_rng_bp" name="check_rng_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Tiki_Chief_Cubie_Blueprint.png" alt="Tiki Chief Cubie" id="img_tiki_chief_bp" name="img_tiki_chief_bp">
                <br>
                Tiki Chief
                <br>
                <input type="checkbox" id="check_tiki_chief_bp" name="check_tiki_chief_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Architect_Cubie_Blueprint.png" alt="Architect Cubie" id="img_architect_bp" name="img_architect_bp">
                <br>
                Architect
                <br>
                <input type="checkbox" id="check_architect_bp" name="check_architect_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>

    </table>
<br>
<table>
        <caption>Cubie Air Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-Marshaller_Cubie_Blueprint.png" alt="Marshaller Cubie" id="img_marshaller_bp" name="img_marshaller_bp">
                <br>
                Marshaller
                <br>
                <input type="checkbox" id="check_marshaller_bp" name="check_marshaller_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Flight_Attendant_Cubie_Blueprint.png" alt="Flight Attendant Cubie" id="img_flight_attendant_bp" name="img_flight_attendant_bp">
                <br>
                Flight Attendant
                <br>
                <input type="checkbox" id="check_flight_attendant_bp" name="check_flight_attendant_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Pilot_Cubie_Blueprint.png" alt="Pilot Cubie" id="img_pilot_bp" name="img_pilot_bp">
                <br>
                Pilot
                <br>
                <input type="checkbox" id="check_pilot_bp" name="check_pilot_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Wombat_Cubie_Blueprint.png" alt="Wombat Cubie" id="img_wombat_bp" name="img_wombat_bp">
                <br>
                Wombat
                <br>
                <input type="checkbox" id="check_wombat_bp" name="check_wombat_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>

    </table>
<br>
<table>
        <caption>Partnership Cubies</caption>
        <tr>
            <td>
                <img src="cubie-bp-images/CubieBP-Doge_Cubie_Blueprint.png" alt="Doge Cubie" id="img_doge_bp" name="img_doge_bp">
                <br>
                Doge
                <br>
                <input type="checkbox" id="check_doge_bp" name="check_doge_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Veriblock_Cubie_Blueprint.png" style="height:120px; margin-bottom:0px;" alt="Veriblock Cubie" id="img_veriblock_bp" name="img_veriblock_bp">
                <br>
                Veriblock
                <br>
                <input type="checkbox" id="check_veriblock_bp" name="check_veriblock_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Suku_Cubie_Blueprint.png" alt="Suku Cubie" id="img_suku_bp" name="img_suku_bp">
                <br>
                Suku
                <br>
                <input type="checkbox" id="check_suku_bp" name="check_suku_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
            <td>
                <img src="cubie-bp-images/CubieBP-Pat_Morita_Cubie_Blueprint.png" alt="Pat Morita Cubie" id="img_pat_morita_bp" name="img_pat_morita_bp">
                <br>
                Pat Morita
                <br>
                <input type="checkbox" id="check_pat_morita_bp" name="check_pat_morita_bp" class="regular-checkbox" onchange="bgChange(this)">
            </td>
        </tr>

    </table>
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