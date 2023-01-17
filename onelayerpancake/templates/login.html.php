<?php
require_once '../keys/storage.php';
//include_once 'header.php';
include_once '../template/layout.html.php';

?>
    <section class="signup-form">
        <h2>Log In</h2>
       <div class="signup-form-form">
<form action="includes/login.inc.php" method="post"><BR>
<input type="text" name="uid" placeholder="user name...."><BR>
<input type="password" name="pwd" placeholder="password...."><BR>
<button type="submit" name="submit">Log In</button>
</form>
</div>

<?php
if (isset($_GET["error"])) {

    if ($_GET["error"] == "emptyinput") {


        echo "<p>Fill in all fields!</p>";
    } else if ($_GET["error"] == "wronglogin") {

        echo "<p>Incorrect login info!</p>";
    } 

}

?>


</section>