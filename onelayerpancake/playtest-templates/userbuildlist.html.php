<?php 
if (isset($error)): ?>
    <p>
      <?php echo $error; ?>
    </p>

<?php 



if (isset($_SESSION["useruid"])) {

    if ($_SESSION["permissions"] === "SPECIAL") {
    print_r($builds,true);
    } else {


        header("location: ../index.php");
exit();
    }


} else {


    header("location: ../index.php");
exit();


}


require_once 'functions.inc.php';



?>


  
    <?php else: ?>
    <?php foreach ($builds as $build): ?>
    <blockquote style="display: table; margin-bottom: 1em; border-bottom: 1px solid #ccc; padding: 0.5em;">
      <p style="display: table-cell; width: 25%; vertical-align: top;background-color:#212121;padding:30px;">



      <?php 
      



















echo " BUILD #";
  
$currentid = $build['id'];
$currentname = $build['name'];
$currentlink = $build['link'];
$currentnotes = $build['notes'];
$currenttested = $build['tested'];





$sql3 = "SELECT * FROM `buildnotes` WHERE `buildid` = ".intval($currentid).";";

$resultss = $pdo ->query($sql3);





















$testedstrng = "tested";

if ($currenttested === "0") {
    $testedstrng = "untested";
}

echo htmlspecialchars($currentid, ENT_QUOTES, 'UTF-8');
echo " - ";

echo htmlspecialchars($currentname, ENT_QUOTES, 'UTF-8');
echo " - ";
echo "<A href='".$currentlink."'>";
echo htmlspecialchars($currentlink, ENT_QUOTES, 'UTF-8');
echo "</A> ";
echo "<BR>";
echo "<BR>";
echo " what needs testing: ";
echo htmlspecialchars($currentnotes, ENT_QUOTES, 'UTF-8');
echo "<BR><BR><BR> ";
?>




<?php
echo htmlspecialchars($testedstrng, ENT_QUOTES, 'UTF-8');
echo " ";

    
// <input type="text" name="usernotes" size=50 placeholder="build notes" value="">

      ?><form style="padding:20px" action="/playtest-includes/marktested.inc.php" method="post">
      <input type="hidden" name="testedid" value="<?php if ($_SESSION["permissions"] === "SPECIAL") { echo $currentid; } ?>">
      <input type="hidden" name="testedv" value="<?php if ($_SESSION["permissions"] === "SPECIAL") { echo $currenttested; } ?>">
      <input type="submit" class="bugga5" value="Mark Tested">
      
    </form>
</p>

<BR><BR><BR>
<div style='padding:30px'>
<form  action="/playtest-includes/addusernotes.inc.php" method="post">
    <input type="hidden" name="testedid" value="<?php if ($_SESSION["permissions"] === "SPECIAL") { echo $currentid; } ?>">
    <input type="hidden" name="username" value="<?php if ($_SESSION["permissions"] === "SPECIAL") { echo $_SESSION["useruid"]; } ?>">
   
    <textarea name="usernotes" rows=15 cols=30 placeholder="build notes" ></textarea><BR>
    <input type="submit" class="bugga4" value="Add notes">
    
  </form>
</DIV>
<BR><BR><BR>


  <DIV style='display: table-cell; width: 43%; max-width:43%'>
<?php foreach ($resultss as $noter): ?>
   
    <blockquote style="display: table; margin-bottom: 1em; border-bottom: 1px solid #ccc; padding: 0.5em;">
  


      <?php 
      




  
$currentnotes = $noter['notes'];
$currentnotesbuildid = $noter['buildid'];
$currentnotesid = $noter['id'];
$currentnotesuser = $noter['username'];

?>

<form action="/playtest-includes/deletethisnote.inc.php" method="post">
    <input type="hidden" name="deleteid" value="<?php if ($_SESSION["permissions"] === "SPECIAL") { echo $currentnotesid; } ?>">
    <input type="hidden" name="deleteuser" value="<?php if ($_SESSION["permissions"] === "SPECIAL") { echo $currentnotesuser; } ?>">
    <input type="submit" class="bugga4" value="Delete" onclick="return confirm('Do you want to submit? Yes/No')">
    
  </form>    <p style="display: table-cell; width: 90%; vertical-align: top;">
<INPUT TYPE="TEXT" style="background-color:black;color:white;border:none;" value="
  <?php
echo $currentnotes;
//echo htmlspecialchars($currentnotes, ENT_QUOTES, 'UTF-8');
//echo " ";

    

?>">


</p>

</blockquote>

    <?php endforeach; ?>
  
</DIV>

    </blockquote>
    <?php endforeach; ?>
    <?php endif; ?>








    <?php 

//<input type="text" name="name" placeholder="full name...."><BR>
//<input type="text" name="email" placeholder="email...."><BR>


if (isset($_GET["error"])) {

    if ($_GET["error"] == "scenario1") {


        echo "<p>scenario 1 happen</p>";
    } else if ($_GET["error"] == "scenario2") {

       echo "<p>scenario 2 happen</p>";
  //  } else if ($_GET["error"] == "invalidemail") {

  //      echo "<p>Choose a proper email!</p>";
    } else if ($_GET["error"] == "scenario3") {

        echo "<p>passwords dont match!</p>";
    } else if ($_GET["error"] == "stmtfailed") {

        echo "<p>Something went wrong! Try Again</p>";
    } else if ($_GET["error"] == "k4") {

        echo "<p>you have triggered k4!</p>";
    } else if ($_GET["error"] == "none") {

        echo "<p>there was a toggle</p>";
    }

}
?>


<BR>
<a href="addconcept.php">Add suggestion/idea/bug report</A><BR>
<a href="https://www.win-rar.com/download.html?&L=0">Where to download winRAR safely</A>
<BR>


    
    <?php echo $output2; ?>