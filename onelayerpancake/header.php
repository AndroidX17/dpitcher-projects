<?php

session_start();



?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>OneLayerPancake <?php echo '$title'.$title?></title>


        <link rel="stylesheet" href="styles.css">
</head>
<body>

<nav>

<div class="wrapper">
    <a href="index.php"><img src="OLP3.png" alt="hi" style="float:left;width:208px;height:102px"></A>
    <BR><BR><BR><BR><BR>
    <ul>
        <!--
        <lI><a href="index.php">Home</A></li>
       
       
        <lI><a href="database.php">DB test</A></li>
        <lI><a href="addconcept.php">Add stuff</A></li>
-->
        <?php

if (isset($_SESSION["useruid"])) {
    echo "<li><a href='profile.php'>Profile page</a></li>";
    echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";

} else {

    echo "<lI><a href='signup.php'>Sign up</A></li>";
    echo "<lI><a href='login.php'>Log in</A></li>";

}

?>

        
        
</ul>
</div>
</nav>

<div class="wrapper">