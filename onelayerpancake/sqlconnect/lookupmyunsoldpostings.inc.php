<?php


if (isset($_POST["code"])) {


    $unity = true;
    $login = true;
    
$username = $_POST["playername"];
    
    require_once '../../keys/storage.php';
    



    if ($conn->connect_error) {
        echo "Error connecting to the database.";
        die();
    }

    // Get the player's name from the form
    $playername = $_POST["playername"];

    // Query the market_items table for the player's postings
    $query = "SELECT id, name, seller, quantity, price, level FROM market_items WHERE seller = '$playername'";
    $result = mysqli_query($conn, $query);

 
    $totalstring = "";


    // Check if the query was successful
    if(mysqli_num_rows($result) > 0) {
       
        while($row = mysqli_fetch_assoc($result)) {
            $totalstring = $totalstring."|" . $row["id"] . "," . $row["name"] . "," . $row["quantity"] . "," . $row["price"] . "," . $row["level"];
        //    $totalstring = $totalstring."|" . $row["id"] . "," . $row["seller"] . "," . $row["quantity"] . "," . $row["price"] . "," . $row["level"];
        }

        echo "0".$totalstring;
    } else {
        echo "1";
    }

    // Close the connection
    mysqli_close($conn);

exit();


    } else {
        echo "1";
        exit();
    }







