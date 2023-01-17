<?php

include_once 'header.php';

?>




    <section class="index-intro">


<?php
    if (isset($_SESSION["useruid"])) {
    echo "<p>hello there " . $_SESSION["useruid"]. "</p>";

} else {

echo "please log in";
}


?>




        <h1>hi</h1>
        <p> stuff</p>
</section>


<section class="index-categories">
    <h2>some stuff</h2>
    <div class="index-categories-list">
        <div>
            <h3> stuff</h3>
</div>
        <div>
            <h3> stuff</h3>
</div>
        <div>
            <h3> stuff</h3>
</div>
        <div>
            <h3> stuff</h3>
</div>




</div>
</section>
<?php

include_once 'footer.php';

?>