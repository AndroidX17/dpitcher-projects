<h2>Database testing</h2>

<p>Welcome to ONELAYERPANCAKE data base test</p>


<section class="index-intro">

<?php

session_start();



?>

<?php
    if (isset($_SESSION["useruid"])) {
    echo "<p>hello there " . $_SESSION["useruid"]. "</p>";

} else {

echo "<p>please log in</p>";
}


?>
