<?php

include_once 'header.php';
require_once '../keys/storage.php';
?>
    <section class="signup-form">
        <h2>sign up</h2>
       <div class="signup-form-form">
<form action="includes/signup.inc.php" method="post">

<input type="text" name="uid" placeholder="username...."><BR>
<input type="password" name="pwd" placeholder="password...."><BR>
<input type="password" name="pwdrepeat" placeholder="repeat pass...."><BR>
<button type="submit" name="submit">Sign Up</button>
</form>
</div>

<?php 

//<input type="text" name="name" placeholder="full name...."><BR>
//<input type="text" name="email" placeholder="email...."><BR>


if (isset($_GET["error"])) {

    if ($_GET["error"] == "emptyinput") {


        echo "<p>Fill in all fields!</p>";
    } else if ($_GET["error"] == "invaliduid") {

       echo "<p>Choose a proper username!</p>";
  //  } else if ($_GET["error"] == "invalidemail") {

  //      echo "<p>Choose a proper email!</p>";
    } else if ($_GET["error"] == "passwordsdontmatch") {

        echo "<p>passwords dont match!</p>";
    } else if ($_GET["error"] == "stmtfailed") {

        echo "<p>Something went wrong! Try Again</p>";
    } else if ($_GET["error"] == "usernametaken") {

        echo "<p>Username taken!</p>";
    } else if ($_GET["error"] == "none") {

        echo "<p>You signed up successfully! You can <a href='login.php'> log in here</a></p>";
    }

}
?>