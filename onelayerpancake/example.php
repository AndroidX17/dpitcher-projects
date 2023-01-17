<SCRIPT language="javascript">


var initialinfo = "stuff";


    </SCRIPT>

<?php 

$customvariable = "SOME STRING";

include __DIR__ . "/templates/exampleheader.html.php";
// this is valid php

// the comments are the same

/*

same comments

*/

function samefunctions() {

    $newvariable = "bob";

if ($newvariable === "bob") {



} else {

}



    
}



?>

<script language="javascript">

// this is valid javascript

function samefunctions() {

    var newvariable = "bob";

if (newvariable === "bob") {



} else {

}



    
}


//var output = "bob";
//var output = '<h2>Database testing</h2><p>Welcome to ONELAYERPANCAKE data base test</p><section class="index-intro">';

    </SCRIPT>


<div>

hello

<?php 

$ourvariable = $_GET["error"];

if (isset($ourvariable)) { 

    echo "we successfully posted your form but rest assured your data doesnt matter";

}

?>

<FORM action="/includes/example.inc.php" method="post">

<INPUT type="text" name="exampletext1" id="exampletext1" placeholder="example 1"><BR>
<INPUT type="text" name="exampletext2" id="exampletext2" placeholder="example 2"><BR>


<INPUT type="submit" id="submit" name="submit"></INPUT>

</FORM>


<HR>

one layer pancake.com 2022

<?php 

echo $customvariable;

?>

<SCRIPT language="Javascript">

document.write(initialinfo);

    </SCRIPT>

</DIV>
</BODY>
</HTML>